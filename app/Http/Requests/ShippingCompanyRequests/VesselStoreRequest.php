<?php

namespace App\Http\Requests\ShippingCompanyRequests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class VesselStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $authenticatedUser = Auth::user();
        if ($authenticatedUser->role->title == 'SHIPPING COMPANY STAFF' && 
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
            'shipping_company_id'=> 'required|exists:shipping_companies,id',
            'imo_number'=> 'required|string|unique:vessels,imo_number', //TO DO: for update, check if same id, allow same
            'registry_number'=> 'sometimes|string|unique:vessels,registry_number',
            'vessel_name'=> 'required|string|unique:vessels,vessel_name',
            'vessel_type'=> 'required|string',
            'grt'=> 'required|numeric',
            'kw'=> 'required|numeric',
            'flag'=> 'required|string',
            'route'=> 'required|string',
        ];
    }
}
