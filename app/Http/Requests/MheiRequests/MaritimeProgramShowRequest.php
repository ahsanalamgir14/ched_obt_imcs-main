<?php

namespace App\Http\Requests\MheiRequests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\MaritimeProgram;

class MaritimeProgramShowRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $mhei_id = MaritimeProgram::find($this->route()->id)->mhei_id;
        $authenticatedUser = Auth::user();
        if ($authenticatedUser->role->title == 'MHEI STAFF' && $authenticatedUser->mhei_staff->mhei_id == $mhei_id)
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
