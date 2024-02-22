<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\VesselStaffs;
use App\Models\User;
use App\Http\Requests\ShippingCompanyRequests;
use App\Http\Requests\UserRequests;
use Illuminate\Support\Facades\DB;

class VesselStaffsController extends Controller
{
    public function index(ShippingCompanyRequests\VesselStaffIndexRequest $request)
    {
        $authenticatedUser = Auth::user();
        if ($authenticatedUser->role->title == 'ADMINISTRATOR')
            return VesselStaffs::with('vessel.shipping_company', 'user')->get();
        else if ($authenticatedUser->role->title == 'SHIPPING COMPANY STAFF')
            return $authenticatedUser->shipping_company_staff->shipping_company->vessel_staffs->load('vessel', 'user');
    }

    public function store(ShippingCompanyRequests\VesselStaffStoreRequest $request)
    {
        DB::beginTransaction();

        if(!$request->validate((new UserRequests\UserStoreRequest)->rules())){
            DB::rollback();
            return response()->json([
                'message' => 'Failed creating Vessel Staff!',
                'error' => $error
            ], 400);
        }

        $user = User::create($request->all());
        $request->query->add(['user_id'=>$user->id]);

        $vessel_staff = VesselStaffs::create($request->toArray());
        DB::commit();

        return response()->json([
            'message' => 'Successfully created Vessel Staff!',
            'vessel_staff' => $vessel_staff->load('user')
        ], 201);
    }

    public function show(ShippingCompanyRequests\VesselStaffIndexRequest $request, int $vessel_staff_id)
    {
        $authenticatedUser = Auth::user();
        if ($authenticatedUser->role->title == 'ADMINISTRATOR')
            return VesselStaffs::find($vessel_staff_id)->with('vessel.shipping_company', 'user')->get();
        else if ($authenticatedUser->role->title == 'SHIPPING COMPANY STAFF')
            return $authenticatedUser->shipping_company_staff->shipping_company->vessel_staffs->find($vessel_staff_id)->load('vessel', 'user');
    }
}
