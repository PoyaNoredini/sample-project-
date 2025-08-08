<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'user_name'        => ['required', 'string', 'max:255', 'unique:users,user_name'],
            'phone_number'     => ['required', 'string', 'max:20', 'unique:users,phone_number', 'regex:/^[0-9+\-\s()]+$/'],
            'password'         => ['required', 'string', 'min:8'],
            'confirm_password' => ['required', 'string', 'same:password'],
            'user_type'        => ['required', 'string', 'in:user,provider'],
            'otp'              => ['required', 'string', 'size:6'],
            'invite_code'      => ['nullable', 'string', 'exists:users,user_name'],

        ];
    }

    /**
     * Get custom error messages for validation rules.
     */
    public function messages(): array
    {
        return [
            'user_name.required'        => 'Username is required.',
            'user_name.unique'          => 'This username is already taken.',
            'phone_number.required'     => 'Phone number is required.',
            'phone_number.unique'       => 'This phone number is already registered.',
            'phone_number.regex'        => 'Please enter a valid phone number.',
            'password.required'         => 'Password is required.',
            'password.min'              => 'Password must be at least 8 characters.',
            'password.confirmed'        => 'Password confirmation does not match.',
            'confirm_password.required' => 'Password confirmation is required.',
            'confirm_password.same'     => 'Password confirmation must match the password.',
            'invite_code.exists'        => 'Invalid invite code.',
        ];
    }
}
