<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminAuthController extends Controller
{
    public function login(Request $request){
        $request->validate([
            'email'=> 'required|string',
            'password'=>'required|string'
        ]);

        $admin = Admin::where('email', $request->email)->first();

        if(!$admin || !Hash::check($request->password, $admin->password)){
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $admin->createToken('AdminToken')->accessToken;

        return response()->json([
            'message' => 'Login successful',
            'token' => $token,
            'admin' => [
            'firstName' => $admin->firstName,
            'lastName' => $admin->lastName
            ]
        ], 200);
    }


    public function logout(Request $request){
        $request->user()->token()->revoke();

        return response()->json(['message'=> 'Logged out successfully']);
    }
}
