<?php

namespace App\Http\Requests\ShippingCompanyRequests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Vessel;

class VesselIndexRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $authenticatedUser = Auth::user();
        if ($authenticatedUser->role->title == 'ADMINISTRATOR' || $authenticatedUser->role->title == 'MARINA' ||
            $authenticatedUser->role->title == 'STUDENT' || $authenticatedUser->role->title == 'CHED STAFF' || $authenticatedUser->role->title == 'SHIPPING COMPANY STAFF')
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
