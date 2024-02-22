<?php

namespace App\Http\Requests\UserRequests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $authenticatedUser = Auth::user();
        if ($authenticatedUser) return true;
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $authenticatedUser = Auth::user();

        return [
            'name' => 'required|string',
            'username' => 'required|string|min:6|unique:users,username,' . $authenticatedUser->id,
            'email' => 'required|email|min:6|unique:users,email,' . $authenticatedUser->id,
            'password' => 'required|string|min:6',
            'role_id' => 'required|exists:roles,id',
            'status' => 'sometimes|string|in:ACTIVE, INACTIVE, PENDING',
        ];
    }
}
