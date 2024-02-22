<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\PcgStaffs;
use App\Models\User;
use App\Http\Requests\PcgRequests;
use App\Http\Requests\UserRequests;
use Illuminate\Support\Facades\DB;

class PcgStaffsController extends Controller
{
    public function index(PcgRequests\PcgStaffIndexRequest $request)
    {
        return PcgStaffs::with('user')->get();
    }

    public function store(PcgRequests\PcgStaffStoreRequest $request)
    {
        $request->query->add(['role_id'=>8]);
        DB::beginTransaction();

        if(!$request->validate((new UserRequests\UserStoreRequest)->rules())){
            DB::rollback();
            return response()->json([
                'message' => 'Failed creating PCG Staff!',
                'error' => $error
            ], 400);
        }

        $user = User::create($request->all());
        $request->query->add(['user_id'=>$user->id]);

        $pcg_staff = PcgStaffs::create($request->toArray());
        DB::commit();

        return response()->json([
            'message' => 'Successfully created PCG Staff!',
            'pcg_staff' => $pcg_staff->load('user')
        ], 201);
    }

    public function show(PcgRequests\PcgStaffShowRequest $request, int $pcg_staff_id)
    {
        return PcgStaffs::find($pcg_staff_id)->load('user');
    }
}
