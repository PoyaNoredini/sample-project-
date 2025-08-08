<?php

namespace App\Contracts\Services;

use App\Contracts\Repositories\Interface\IUserRepository;
use App\Contracts\Services\Contracts\IUserService;
use App\Contracts\Services\Contracts\IUuidConversionService;
use App\Contracts\Services\Contracts\IFileUploadService;
use Illuminate\Http\UploadedFile;

class UserService implements IUserService
{
    protected IUserRepository $userRepository;
    protected IUuidConversionService $uuidConversionService;
    protected IFileUploadService $fileUploadService;


    public function __construct(
        IUserRepository $userRepository,
        IUuidConversionService $uuidConversionService,
        IFileUploadService $fileUploadService
    ) {
        $this->userRepository        = $userRepository;
        $this->uuidConversionService = $uuidConversionService;
        $this->fileUploadService     = $fileUploadService;
    }

    public function index()
    {
        return $this->userRepository->index();
    }

    public function show(int $id)
    {
        return $this->userRepository->show($id);
    }

    public function update(int $id, array $data)
    {
        // Handle profile image upload if present
        if (isset($data['profile']) && $data['profile'] instanceof UploadedFile) {
            $profileUrl = $this->fileUploadService->uploadProfileImage($data['profile'], $id, 'uploads/profile');

            if ($profileUrl) {
                // Replace the uploaded file with the URL
                $data['profile'] = $profileUrl;
            } else {
                // Remove profile from data if upload failed
                unset($data['profile']);
            }
        }

        // Convert UUIDs to IDs using injected service
        $data = $this->uuidConversionService->processUserData($data);

        return $this->userRepository->update($data, $id);
    }

    public function delete(int $id)
    {
        return $this->userRepository->delete($id);
    }
}
