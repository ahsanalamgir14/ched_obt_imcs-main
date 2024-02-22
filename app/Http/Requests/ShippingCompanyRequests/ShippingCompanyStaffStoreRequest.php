<?php

namespace App\Http\Requests\ShippingCompanyRequests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ShippingCompanyStaffStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $authenticatedUser = Auth::user();
        if ($authenticatedUser->role->title == 'ADMINISTRATOR')
            return true;
        else if ($authenticatedUser->role->title == 'SHIPPING COMPANY STAFF' && $authenticatedUser->shipping_company_staff->top_level_access && 
            $authenticatedUser->shipping_company_staff->shipping_company_id == request()->shipping_company_id)
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
            'shipping_company_id'=>'required|exists:shipping_companies,id',
            'birthdate'=>'sometimes|date',
            'position'=>'sometimes|string',
            'gender'=>'required|string|in:MALE,FEMALE',
            'contact_number'=>'sometimes|string',  //TO DO: Unique per staff of same shipping company
            'top_level_access'=>'sometimes|boolean'
        ];
    }
}
