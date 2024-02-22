<?php

namespace App\Http\Requests\ShippingCompanyRequests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Vessel;

class VesselStaffStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $shipping_company_id = Vessel::find(request()->vessel_id)->shipping_company_id;
        $authenticatedUser = Auth::user();
        if ($authenticatedUser->role->title == 'SHIPPING COMPANY STAFF' &&
            $authenticatedUser->shipping_company_staff->shipping_company_id == $shipping_company_id)
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
            'vessel_id'=>'required|exists:vessels,id',
            'role_id'=>'required|exists:roles,id',
            'birthdate'=>'required|date',
            'rank'=>'required|string',
            'nationality'=>'required|string',
            'contact_number'=>'required|string', //TO DO: unique per staff in same vessel/ship
        ];
    }
}
