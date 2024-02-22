<?php

namespace App\Http\Requests\StudentRequests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserRequests;

class ObtApplicationStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $authenticatedUser = Auth::user();
        if ($authenticatedUser->role->title == 'STUDENT')
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
            'student_id'=> 'required|exists:students,id',
            'status'=>'sometimes|string|in:APPROVED, PENDING, REJECTED',
            'remarks'=> 'sometimes|string',
            'vessel_id'=> 'sometimes|exists:vessels,id',
            'shipping_company_id'=> 'sometimes|exists:shipping_companies,id',
        ];
    }
}
