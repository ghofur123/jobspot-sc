<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Dotenv\Validator;
use Illuminate\Http\Request;

class Login_users extends Controller
{
    public function login(Request $request)
    {
        $validation =  Validator($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if ($validation->fails()) {
            return response([
                'status' => true,
                'message' => $validation->errors()
            ]);
        }
        $user = User::where([
            'email' => $request->email,
            'password' => sha1($request->password)
        ])->first();
        if ($user) {
            if (!empty($user->email_verified_at)) {
                return response([
                    'message' => 'success',
                    'token' => $user->createToken('ApiToken')->plainTextToken
                ], 200);
            } else {
                return response([
                    'message' => 'Email Belum Di verifikasi',
                    // 'token' => $user->createToken('ApiToken')->plainTextToken
                ], 400);
            }
        } else {
            return response([
                'message' => 'email atau password salah'
            ]);
        }
    }
}
