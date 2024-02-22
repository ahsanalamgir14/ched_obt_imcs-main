<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Http\Requests\UserRequests;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(UserRequests\UserIndexRequest $request)
    {
        return User::with('role')->get();
    }

    public function login(UserRequests\UserLoginRequest $request)
    {
        $user = User::where('username', $request->username)->first();
        
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('LaravelPasswordGrantClient')->accessToken;

                // return $user;

                return response()->json([
                    'token' => $token,
                    'user' => $user->load('role')
                ]);
            }
        }

        return response('Invalid Credentials', 401);
    }

    public function store(UserRequests\UserStoreRequest $request)
    {
        try{
            $user = User::create($request->toArray());

            return response()->json([
                'message' => 'Successfully created user account!',
                'user' => $user
            ], 201);
        }
        catch (Throwable $error) {
            return response()->json([
                'message' => 'Failed creating account!',
                'error' => $error
            ], 400);
        }
    }
    
    public function show(UserRequests\UserShowRequest $request, int $user_id)
    {
        return User::find($user_id)->load('role');
    }

    public function logout()
    {
        $token = Auth::user()->token();
        $token->revoke();
        return response()->json([
            'message' => 'Successfully logged out!'
        ], 200);
    }
    
    public function change_password(UserRequests\UserChangePasswordRequest $request)
    {
        if ($request->has('old_password')) {
            
        }

        return Auth::user()->update(['password'=>$request->password, 'default_password'=>false]);
        // return Auth::user()->update(['password'=>$request->password]);
    }
}
