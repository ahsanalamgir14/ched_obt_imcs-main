<?php

namespace App\Http\Requests\MheiRequests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ShippingCompanyStaffShowRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $authenticatedUser = Auth::user();
        if ($authenticatedUser->role->title == 'ADMINISTRATOR')
            return true;
        else if ($authenticatedUser->role->title == 'SHIPPING COMPANY STAFF' && $authenticatedUser->shipping_company_staff->top_level_access)
            return true;
        else if ($authenticatedUser->role->title == 'SHIPPING COMPANY STAFF' && $authenticatedUser->shipping_company_staff->id == $this->route()->id)
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
