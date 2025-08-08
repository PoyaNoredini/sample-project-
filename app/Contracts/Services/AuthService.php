<?php

namespace App\Contracts\Services;

use App\Contracts\Services\Contracts\IAuthService;
use App\Contracts\Services\Contracts\IOtpService;
use App\Contracts\Services\Contracts\IInviteCodeService;
use App\Contracts\Repositories\Interface\IAuthRepository;
use Illuminate\Support\Facades\Hash;
use App\Models\OtpCode;
use Illuminate\Validation\ValidationException;
use App\Helpers\CreateTokenHelper;

class AuthService implements IAuthService
{
    protected IAuthRepository $authRepository;
    protected IOtpService $otpService;
    protected IInviteCodeService $inviteCodeService;

    public function __construct(IAuthRepository $authRepository, IOtpService $otpService, IInviteCodeService $inviteCodeService)
    {
        $this->authRepository    = $authRepository;
        $this->otpService        = $otpService;
        $this->inviteCodeService = $inviteCodeService;
    }

    public function register(array $userData)
    {
        $otp = OtpCode::where('phone_number', $userData['phone_number'])->first();
        if ($otp->otp_code != $userData['otp']) {
            throw ValidationException::withMessages([
                'otp' => ['The provided otp is incorrect.']
            ]);
        }
        // Hash the password
        $userData['password'] = Hash::make($userData['password']);

        if (!empty($userData['invite_code'])) {
            $this->addInviteCodeCount($userData['invite_code']);
        }
        // Remove confirm_password from data before storing
        $userData = $this->unsetData($userData);
        // Create user via repository
        $user = $this->authRepository->register($userData);

        // Generate authentication token
        $token = CreateTokenHelper::createAccessToken($user);
        // Create invite code
        $this->createInviteCode($user);

        return [
            'user'    => $user,
            'token'   => $token,
            'message' => 'User registered successfully'
        ];
    }

    public function login(array $credentials)
    {
        // Find user by phone number
        $user = $this->authRepository->login($credentials);

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            throw ValidationException::withMessages([
                'user_name' => ['The provided credentials are incorrect.']
            ]);
        }

        // Generate authentication token
        $token = CreateTokenHelper::createAccessToken($user);

        return [
            'user'    => $user,
            'token'   => $token,
            'message' => 'Login successful'
        ];
    }

    public function forgotPassword(array $payload)
    {
        // Find user by username or phone number
        $user = $this->authRepository->forgotPassword($payload);

        if (!$user) {
            throw ValidationException::withMessages([
                'user' => ['User not found.']
            ]);
        }

        // Generate and send OTP to user's phone number
        $otp = $this->otpService->generateOTP($user->phone_number);

        return [
            'user_id'      => $user->id,
            'phone_number' => $user->phone_number,
            'otp'          => $otp,
            'message'      => 'OTP sent successfully for password reset'
        ];
    }
    private function createInviteCode($user)
    {
        $data = [
            'user_id' => $user->id,
            'code'    => $user->user_name,
        ];
        return $this->inviteCodeService->store($data);
    }
    private function addInviteCodeCount(string $code)
    {
        $inviteCode = $this->inviteCodeService->addInviteCodeCount($code);

        if ($inviteCode) {
            $data['count'] = $inviteCode->count + 1;
            $this->inviteCodeService->update($inviteCode->id, $data);
            return true;
        }
        return false;
    }
    private function unsetData(array $data)
    {
        unset($data['confirm_password']);
        if (isset($data['invite_code'])) {
            unset($data['invite_code']);
        }
        unset($data['otp']); // Also remove OTP from user data before storing
        return $data;
    }

}
