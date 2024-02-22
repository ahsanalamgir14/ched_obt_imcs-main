<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\MheiStaffs;
use App\Models\User;
use App\Http\Requests\MheiRequests;
use App\Http\Requests\UserRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MheiStaffsController extends Controller
{
    public function index(MheiRequests\MheiStaffIndexRequest $request)
    {
        $authenticatedUser = Auth::user();
        if ($authenticatedUser->role->title == 'ADMINISTRATOR' || $authenticatedUser->role->title == 'CHED STAFF')
            return MheiStaffs::with('mhei', 'user')->get();
        else if ($authenticatedUser->role->title == 'MHEI STAFF')
            return $authenticatedUser->mhei_staff->mhei->mhei_staffs->load('user');
    }

    public function store(MheiRequests\MheiStaffStoreRequest $request)
    {
        $request->query->add(['role_id'=>2]);
        DB::beginTransaction();

        if(!$request->validate((new UserRequests\UserStoreRequest)->rules())){
            DB::rollback();
            return response()->json([
                'message' => 'Failed creating MHEI Staff!',
                'error' => $error
            ], 400);
        }

        $user = User::create($request->all());
        $request->query->add(['user_id'=>$user->id]);

        $mhei_staff = MheiStaffs::create($request->toArray());
        DB::commit();

        return response()->json([
            'message' => 'Successfully created MHEI Staff!',
            'mhei_staff' => $mhei_staff->load('user')
        ], 201);
    }

    public function show(MheiRequests\MheiStaffShowRequest $request, int $mhei_staff_id)
    {
        $authenticatedUser = Auth::user();
        if ($authenticatedUser->role->title == 'ADMINISTRATOR' || $authenticatedUser->role->title == 'CHED STAFF')
            return MheiStaffs::find($mhei_staff_id)->with('mhei', 'user')->get();
        else if ($authenticatedUser->role->title == 'MHEI STAFF')
            return MheiStaffs::find($mhei_staff_id)->load('user');
    }
}
