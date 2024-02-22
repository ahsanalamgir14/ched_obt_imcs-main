<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ChedStaffs;
use App\Models\User;
use App\Http\Requests\ChedRequests;
use App\Http\Requests\UserRequests;
use Illuminate\Support\Facades\DB;

class ChedStaffsController extends Controller
{
    public function index(ChedRequests\ChedStaffIndexRequest $request)
    {
        return ChedStaffs::with('user')->get();
    }

    public function store(ChedRequests\ChedStaffStoreRequest $request)
    {
        $request->query->add(['role_id'=>3]);
        DB::beginTransaction();

        if(!$request->validate((new UserRequests\UserStoreRequest)->rules())){
            DB::rollback();
            return response()->json([
                'message' => 'Failed creating CHED Staff!',
                'error' => $error
            ], 400);
        }

        $user = User::create($request->all());
        $request->query->add(['user_id'=>$user->id]);

        $ched_staff = ChedStaffs::create($request->toArray());
        DB::commit();

        return response()->json([
            'message' => 'Successfully created CHED Staff!',
            'ched_staff' => $ched_staff->load('user')
        ], 201);
    }

    public function show(ChedRequests\ChedStaffShowRequest $request, int $ched_staff_id)
    {
        return ChedStaffs::find($ched_staff_id)->load('user');
    }
}
