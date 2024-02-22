<?php

namespace App\Http\Requests\MarinaRequests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class MarinaStaffStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $authenticatedUser = Auth::user();
        if ($authenticatedUser->role->title == 'ADMINISTRATOR')
            return true;
        else if ($authenticatedUser->role->title == 'MARINA STAFF' && $authenticatedUser->marina_staff->top_level_access)
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
            'birthdate'=>'required|date',
            'gender'=>'required|in:FEMALE,MALE',
            'contact_number'=>'required|string|unique:marina_staffs,contact_number', //TO DO: for update, check if same id, allow same
        ];
    }
}
