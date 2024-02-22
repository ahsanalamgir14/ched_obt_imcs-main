<?php

namespace App\Http\Requests\ChedRequests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ChedStaffStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $authenticatedUser = Auth::user();
        if ($authenticatedUser->role->title == 'ADMINISTRATOR')
            return true;
        else if ($authenticatedUser->role->title == 'CHED STAFF' && $authenticatedUser->ched_staff->top_level_access)
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
            'position'=>'required|string',
            'regional_office_assigned'=>'required|string',
            'birthdate'=>'required|date',
            'contact_number'=>'required|string|unique:ched_staffs,contact_number', //TO DO: for update, check if same id, allow same
            'top_level_access'=>'sometimes|boolean'
        ];
    }
}
