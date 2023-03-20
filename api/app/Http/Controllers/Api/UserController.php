<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if(Auth::attempt($credentials)){
            $token = Auth::user()->createToken('appToken')->plainTextToken;
            return response()->json(['token' => $token]);
        }
        return response()->json(['msg' => 'Credenciales invalidas']);

    }

    public function createUser(CreateRequest $request)
    {
        return response()->json(User::create($request->all()));
    }
}
