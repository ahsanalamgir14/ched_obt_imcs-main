<?php

namespace App\Http\Requests\ShippingCompanyRequests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\VesselStaffs;

class VesselStaffShowRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $shipping_company_id = VesselStaffs::find($this->route()->id)->vessel->shipping_company_id;
        $authenticatedUser = Auth::user();
        if ($authenticatedUser->role->title == 'ADMINISTRATOR')
            return true;
        if ($authenticatedUser->role->title == 'SHIPPING COMPANY STAFF' && $authenticatedUser->shipping_company_staff->shipping_company_id == $shipping_company_id)
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
