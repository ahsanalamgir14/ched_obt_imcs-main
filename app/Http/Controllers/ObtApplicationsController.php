<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\StudentRequests;
use Illuminate\Support\Facades\Auth;
use App\Models\ObtApplications;
use App\Models\ShippingCompany;
use App\Models\Vessel;

class ObtApplicationsController extends FormRequest
{
    public function index(StudentRequests\ObtApplicationIndexRequest $request)
    {
        $authenticatedUser = Auth::user();
        if ($authenticatedUser->role->title == 'SHIPPING COMPANY STAFF')
            return response()->json([
                'shipping_company_applications' => $authenticatedUser->shipping_company_staff->shipping_company->applications,
                'vessel_applications' => $authenticatedUser->shipping_company_staff->shipping_company->vessel_applications,
            ], 200);
        else
            return ObtApplications::with('student.user', 'applicable')->get();
    }

    public function store(Request $request)
    {
        $authenticatedUser = Auth::user();
        $request->query->add(['student_id'=>$authenticatedUser->student->id]);
        
        if(!$request->validate((new StudentRequests\ObtApplicationStoreRequest)->rules())){
            return response()->json([
                'message' => 'Failed creating MHEI!',
                'error' => $error
            ], 400);
        }
        try{
            if ($request->has('vessel_id')){
                $vessel = Vessel::find($request->vessel_id);
                $obtApplication = $vessel->applications()->create($request->toArray());
            }
            else if ($request->has('shipping_company_id')){
                $shipping_company = ShippingCompany::find($request->shipping_company_id);
                $obtApplication = $shipping_company->applications()->create($request->toArray());
            }
            
            return response()->json([
                'message' => 'Successfully created Vessel!',
                'obtApplication' => $obtApplication
            ], 201);
        }
        catch (Throwable $error) {
            return response()->json([
                'message' => 'Failed creating Vessel!',
                'error' => $error
            ], 400);
        }
    }

    
}
