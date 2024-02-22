<?php

namespace App\Http\Requests\PcgRequests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;


class PcgStaffStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $authenticatedUser = Auth::user();
        if ($authenticatedUser->role->title == 'ADMINISTRATOR')
            return true;
        else if ($authenticatedUser->role->title == 'PCG STAFF' && $authenticatedUser->pcg_staff->top_level_access)
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
            'rank'=>'required|string',
            'unit_assigned'=>'required|string',
            'unit_address'=>'required|string',
            'birthdate'=>'required|string',
            'contact_number'=>'required|string|unique:pcg_staffs,contact_number', //TO DO: for update, check if same id, allow same
            'top_level_access'=>'sometimes|boolean'
        ];
    }
}
