<?php

namespace App\Http\Requests\MheiRequests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class MaritimeProgramStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $authenticatedUser = Auth::user();
        if ($authenticatedUser->role->title == 'MHEI STAFF' && $authenticatedUser->mhei_staff->mhei_id == request()->mhei_id)
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
            'mhei_id'=>'required|exists:mheis,id',
            'course'=>'required|string|unique:maritime_programs,course,,,mhei_id,' .request()->mhei_id,
            'description'=>'option|string',
            'status'=>'sometimes|string|in:OFFERED,NOT OFFERED',
            'top_level_access'=>'sometimes|boolean'
        ];
    }
}
