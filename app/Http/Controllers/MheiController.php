<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Mhei;
use App\Models\MheiStaffs;
use App\Models\User;
use App\Http\Requests\MheiRequests;
use App\Http\Requests\UserRequests;
use Illuminate\Support\Facades\DB;

class MheiController extends Controller
{
    public function index(MheiRequests\MheiIndexRequest $request)
    {
        return Mhei::all();
    }

    public function store(MheiRequests\MheiStoreRequest $request)
    {
        DB::beginTransaction();

        $mhei = Mhei::create($request->all());
        $request->query->add(['mhei_id'=>$mhei->id, 'role_id'=>2]);
        
        if(!$request->validate((new UserRequests\UserStoreRequest)->rules())){
            DB::rollBack();
            return response()->json([
                'message' => 'Failed creating MHEI!',
                'error' => $error
            ], 400);
        }

        $user = User::create($request->all());
        $request->query->add(['user_id'=>$user->id, 'top_level_access'=>true]);
        
        if(!$request->validate((new MheiRequests\MheiStaffStoreRequest)->rules())){
            DB::rollBack();
            return response()->json([
                'message' => 'Failed creating MHEI!',
                'error' => $error
            ], 400);
        }
        
        $mhei_staff = MheiStaffs::create($request->all());
        DB::commit();

        return response()->json([
            'message' => 'Successfully created MHEI!',
            'mhei' => $mhei->load('mhei_staffs.user')
        ], 201);
    }

    public function show(MheiRequests\MheiIndexRequest $request, int $mhei_id)
    {
        return Mhei::find($mhei_id)->load('maritime_programs', 'mhei_staffs.user', 'students.user');
    }
}
