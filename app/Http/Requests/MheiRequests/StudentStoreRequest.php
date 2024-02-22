<?php

namespace App\Http\Requests\MheiRequests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StudentStoreRequest extends FormRequest
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
            'maritime_program_id'=>'required|exists:maritime_programs,id',
            'file_id'=>'sometimes|exists:files,id',
            'student_number'=>'required|unique:students,student_number', //TO DO: for update, if same id allow same
            'sirb_number'=>'sometimes|string',
            'sid_number'=>'sometimes|string',
            'gender'=>'required|string|in:MALE,FEMALE',
            'birthdate'=>'sometimes|date',
            'address'=>'sometimes|string',
            'civil_status'=>'sometimes|in:SINGLE,MARRIED,WIDOWED,DIVORCED,SEPARATED',
            'citizenship'=>'sometimes|string',
            'religion'=>'sometimes|string',
            'height'=>'sometimes|numeric',
            'weight'=>'sometimes|numeric',
            'contact_number'=>'sometimes|string|unique:students,contact_number', //TO DO: for update, if same id allow same
        ];
    }
}
