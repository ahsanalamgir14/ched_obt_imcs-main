<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ShippingCompany;
use App\Models\ShippingCompanyStaffs;
use App\Models\User;
use App\Http\Requests\ShippingCompanyRequests;
use App\Http\Requests\UserRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ShippingCompanyController extends Controller
{
    public function index(ShippingCompanyRequests\ShippingCompanyIndexRequest $request)
    {
        return ShippingCompany::all();
    }

    public function store(ShippingCompanyRequests\ShippingCompanyStoreRequest $request)
    {
        DB::beginTransaction();

        $shipping_company = ShippingCompany::create($request->all());
        $request->query->add(['shipping_company_id'=>$shipping_company->id, 'role_id'=>4]);
        
        if(!$request->validate((new UserRequests\UserStoreRequest)->rules())){
            DB::rollBack();
            return response()->json([
                'message' => 'Failed creating Shipping Company!',
                'error' => $error
            ], 400);
        }

        $user = User::create($request->all());
        $request->query->add(['user_id'=>$user->id, 'top_level_access'=>true]);
        
        if(!$request->validate((new ShippingCompanyRequests\ShippingCompanyStaffStoreRequest)->rules())){
            DB::rollBack();
            return response()->json([
                'message' => 'Failed creating Shipping Company!',
                'error' => $error
            ], 400);
        }
        
        $shipping_company_staff = ShippingCompanyStaffs::create($request->all());
        DB::commit();

        return response()->json([
            'message' => 'Successfully created Shipping Company!',
            'shipping_company' => $shipping_company->load('shipping_company_staffs.user')
        ], 201);
    }

    public function show(ShippingCompanyRequests\ShippingCompanyShowRequest $request, int $shipping_company_id)
    {
        $authenticatedUser = Auth::user();
        if ($authenticatedUser->role->title == 'STUDENT')
            return ShippingCompany::find($shipping_company_id)->load('vessels');
        else
            return ShippingCompany::find($shipping_company_id)->load('vessels', 'shipping_company_staffs');
    }
}
