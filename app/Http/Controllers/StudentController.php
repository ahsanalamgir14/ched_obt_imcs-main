<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Student;
use App\Models\User;
use App\Http\Requests\MheiRequests;
use App\Http\Requests\UserRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function index(MheiRequests\StudentIndexRequest $request)
    {
        return Student::with('maritime_program.mhei', 'user')->get();
    }

    public function store(Request $request)
    {
        $default_password = 'DP-'.substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'),0,6);
        DB::beginTransaction();
        $request->query->add(['role_id'=>10]);
        $request->query->add(['password'=>$default_password]);
        $request->query->add(['default_password'=>true]);

        if(!$request->validate((new UserRequests\UserStoreRequest)->rules())){
            DB::rollback();
            return response()->json([
                'message' => 'Failed creating Student!',
                'error' => $error
            ], 400);
        }

        $user = User::create($request->all());
        $request->query->add(['user_id'=>$user->id]);
        $request->query->add(['mhei_id'=>Auth::user()->mhei_staff->mhei_id]);

        if(!$request->validate((new MheiRequests\StudentStoreRequest)->rules())){
            DB::rollback();
            return response()->json([
                'message' => 'Failed creating Student!',
                'error' => $error
            ], 400);
        }

        $student = Student::create($request->toArray());
        DB::commit();

        return response()->json([
            'message' => 'Successfully created Student!',
            'student' => $student->load('user'),
            'default_password'=> $default_password
        ], 201);
    }

    public function show(MheiRequests\StudentShowRequest $request, int $student_id)
    {
        $authenticatedUser = Auth::user();
        if ($authenticatedUser->role->title == 'STUDENT')
            Student::find($student_id)->with('maritime_program.mhei', 'user')->get();
        else
            return $authenticatedUser->student->load('maritime_program.mhei', 'user');
    }
}
