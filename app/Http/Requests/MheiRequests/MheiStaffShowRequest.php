<?php

namespace App\Http\Requests\MheiRequests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class MheiStaffShowRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $authenticatedUser = Auth::user();
        if ($authenticatedUser->role->title == 'ADMINISTRATOR' || $authenticatedUser->role->title == 'CHED STAFF')
            return true;
        else if ($authenticatedUser->role->title == 'MHEI STAFF' && $authenticatedUser->mhei_staff->top_level_access)
            return true;
        else if ($authenticatedUser->role->title == 'MHEI STAFF' && $authenticatedUser->mhei_staff->id == $this->route()->id)
            return true;
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
        ];
    }
}
