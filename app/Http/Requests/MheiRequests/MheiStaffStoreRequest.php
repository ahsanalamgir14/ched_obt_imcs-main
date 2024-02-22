<?php

namespace App\Http\Requests\MheiRequests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class MheiStaffStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $authenticatedUser = Auth::user();
        if ($authenticatedUser->role->title == 'ADMINISTRATOR' || $authenticatedUser->role->title == 'CHED STAFF')
            return true;
        else if ($authenticatedUser->role->title == 'MHEI STAFF' && $authenticatedUser->mhei_staff->top_level_access && $authenticatedUser->mhei_staff->mhei_id == request()->mhei_id)
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
            // 'user_id'=>'required|exists:users,id',
            'mhei_id'=>'required|exists:mheis,id',
            'birthdate'=>'sometimes|date',
            'gender'=>'required|string|in:MALE,FEMALE',
            'contact_number'=>'sometimes|string',  //TO DO: Unique per staff of same mhei
            'position'=>'sometimes|string',
            'educational_background'=>'sometimes|string',
            'top_level_access'=>'sometimes|boolean'
        ];
    }
}
