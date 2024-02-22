<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\MarinaStaffs;
use App\Models\User;
use App\Http\Requests\MarinaRequests;
use App\Http\Requests\UserRequests;
use Illuminate\Support\Facades\DB;

class MarinaStaffsController extends Controller
{
    public function index(MarinaRequests\MarinaStaffIndexRequest $request)
    {
        return MarinaStaffs::with('user')->get();
    }

    public function store(MarinaRequests\MarinaStaffStoreRequest $request)
    {
        $request->query->add(['role_id'=>9]);
        DB::beginTransaction();

        if(!$request->validate((new UserRequests\UserStoreRequest)->rules())){
            DB::rollback();
            return response()->json([
                'message' => 'Failed creating Marina Staff!',
                'error' => $error
            ], 400);
        }

        $user = User::create($request->all());
        $request->query->add(['user_id'=>$user->id]);

        $marina_staff = MarinaStaffs::create($request->toArray());
        DB::commit();

        return response()->json([
            'message' => 'Successfully created Marina Staff!',
            'marina_staff' => $marina_staff->load('user')
        ], 201);
    }

    public function show(MarinaRequests\MarinaStaffShowRequest $request, int $marina_staff_id)
    {
        return MarinaStaffs::find($marina_staff_id)->load('user');
    }
}
