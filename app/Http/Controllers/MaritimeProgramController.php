<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\MaritimeProgram;
use App\Http\Requests\MheiRequests;
use Illuminate\Support\Facades\Auth;

class MaritimeProgramController extends Controller
{
    public function index(MheiRequests\MaritimeProgramIndexRequest $request)
    {
        $authenticatedUser = Auth::user();
        if ($authenticatedUser->role->title == 'MHEI STAFF')
            return $authenticatedUser->mhei_staff->mhei->maritime_programs;
    }

    public function store(MheiRequests\MaritimeProgramStoreRequest $request)
    {
        try{
            $maritime_program = MaritimeProgram::create($request->toArray());

            return response()->json([
                'message' => 'Successfully created Maritime Program!',
                'maritime_program' => $maritime_program
            ], 201);
        }
        catch (Throwable $error) {
            return response()->json([
                'message' => 'Failed creating Maritime Program!',
                'error' => $error
            ], 400);
        }
    }

    public function show(MheiRequests\MaritimeProgramShowRequest $request, int $maritime_program_id)
    {
        return MaritimeProgram::find($maritime_program_id)->with('students')->get();
    }
}
