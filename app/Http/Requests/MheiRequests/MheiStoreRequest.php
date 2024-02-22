<?php

namespace App\Http\Requests\MheiRequests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserRequests;

class MheiStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $authenticatedUser = Auth::user();
        if ($authenticatedUser->role->title == 'ADMINISTRATOR' || $authenticatedUser->role->title == 'CHED STAFF')
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
            'school_name'=>'required|string|unique:mheis,school_name', //TO DO: for update, check if same id, allow same
            'school_type'=>'required|string|in:PUBLIC, PRIVATE',
            'region'=>'required|string',
            'address'=>'required|string',
            'status'=>'sometimes|string|in:ENABLED,DISABLED',
        ];
    }
}
