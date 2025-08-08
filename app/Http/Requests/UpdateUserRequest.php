<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'             => 'nullable|string|max:255',
            'user_name'        => 'nullable|string|max:255|unique:users,user_name,' . $this->route('user'),
            'password'         => 'nullable|string|min:8',
            'confirm_password' => 'nullable|string|min:8|same:password',
            'birthday'         => 'nullable|date',
            'profile'          => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gender'           => 'nullable|string|in:male,female,other',
            'bio'              => 'nullable|string',
            'city_id'          => 'nullable|exists:cities,uuid',
            'state_id'         => 'nullable|exists:states,uuid',
           
        ];
    }
}
