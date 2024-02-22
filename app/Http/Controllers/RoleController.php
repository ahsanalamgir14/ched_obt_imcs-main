<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Role;
use App\Http\Requests;

class RoleController extends Controller
{
    public function index(Requests\RoleShowIndexRequest $request)
    {
        return Role::all();
    }

    public function store(Requests\RoleStoreRequest $request)
    {
        try{
            $role = Role::create($request->toArray());

            return response()->json([
                'message' => 'Successfully created role!',
                'role' => $role
            ], 201);
        }
        catch (Throwable $error) {
            return response()->json([
                'message' => 'Failed creating role!',
                'error' => $error
            ], 400);
        }
    }

    public function show(Requests\RoleShowIndexRequest $request, int $role_id)
    {
        return Role::find($role_id)->load('users');
    }
}
