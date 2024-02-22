<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Vessel;
use App\Http\Requests\ShippingCompanyRequests;
use Illuminate\Support\Facades\Auth;

class VesselController extends Controller
{
    public function index(ShippingCompanyRequests\VesselIndexRequest $request)
    {
        $authenticatedUser = Auth::user();
        if ($authenticatedUser->role->title == 'SHIPPING COMPANY STAFF')
            return $authenticatedUser->shipping_company_staff->shipping_company->vessels->load('shipping_company');
        else
            return Vessel::with('shipping_company')->get();
    }

    public function store(ShippingCompanyRequests\VesselStoreRequest $request)
    {
        try{
            $vessel = Vessel::create($request->toArray());

            return response()->json([
                'message' => 'Successfully created Vessel!',
                'vessel' => $vessel
            ], 201);
        }
        catch (Throwable $error) {
            return response()->json([
                'message' => 'Failed creating Vessel!',
                'error' => $error
            ], 400);
        }
    }

    public function show(ShippingCompanyRequests\VesselShowRequest $request, int $vessel_id)
    {
        $authenticatedUser = Auth::user();
        if ($authenticatedUser->role->title == 'STUDENT')
            return Vessel::find($vessel_id)->with('shipping_company')->get();
        else
            return Vessel::find($vessel_id)->with('shipping_company', 'vessel_staffs')->get();
    }
}
