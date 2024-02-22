<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ShippingCompanyStaffs;
use App\Models\User;
use App\Http\Requests\ShippingCompanyRequests;
use App\Http\Requests\UserRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ShippingCompanyStaffsController extends Controller
{
    public function index(ShippingCompanyRequests\ShippingCompanyShowRequest $request)
    {
        $authenticatedUser = Auth::user();
        if ($authenticatedUser->role->title == 'ADMINISTRATOR')
            return ShippingCompanyStaffs::with('shipping_company', 'user')->get();
        else if ($authenticatedUser->role->title == 'SHIPPING COMPANY STAFF')
            return $authenticatedUser->shipping_company_staff->shipping_company->shipping_company_staffs->load('user');
    }

    public function store(ShippingCompanyRequests\ShippingCompanyStaffStoreRequest $request)
    {
        $request->query->add(['role_id'=>4]);
        DB::beginTransaction();

        if(!$request->validate((new UserRequests\UserStoreRequest)->rules())){
            DB::rollback();
            return response()->json([
                'message' => 'Failed creating Shipping Company Staff!',
                'error' => $error
            ], 400);
        }

        $user = User::create($request->all());
        $request->query->add(['user_id'=>$user->id]);

        $shipping_company_staff = ShippingCompanyStaffs::create($request->toArray());
        DB::commit();

        return response()->json([
            'message' => 'Successfully created Shipping Company Staff!',
            'shipping_company_staff' => $shipping_company_staff->load('user')
        ], 201);
    }

    public function show(ShippingCompanyRequests\ShippingCompanyShowRequest $request, int $shipping_company_staff_id)
    {
        $authenticatedUser = Auth::user();
        if ($authenticatedUser->role->title == 'ADMINISTRATOR')
            return ShippingCompanyStaffs::find($shipping_company_staff_id)->with('shipping_company', 'user')->get();
        else if ($authenticatedUser->role->title == 'SHIPPING COMPANY STAFF')
            return ShippingCompanyStaffs::find($shipping_company_staff_id)->load('user');
    }
}
