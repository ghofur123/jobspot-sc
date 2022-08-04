<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class Users_mail extends Controller
{
    public function reset_password(Request $request)
    {
        $validation = Validator($request->all(), [
            'email' => 'required|email'
        ]);
        if ($validation->fails()) {
            return response([
                'status' => false,
                'validation' => $validation->errors()
            ], 400);
        }
        // $user = User::where([
        //     'email' => $request->email
        // ])->get();
        // if ($user != null) {
        $password = rand(00000000000, 999999999999);
        User::where([
            'email' => $request->email
        ])->update([
            'password' => sha1($password)
        ]);
        Mail::to($request->email)->send(new \App\Mail\Users_forget($password));
        return response([
            'success' => true,
            'message' => 'verifikasi berhasil'
        ], 200);
        // }
    }
    public function verified(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        if (!empty($request->token)) {
            User::where([
                'remember_token' => $request->token
            ])->update([
                'email_verified_at' => date('Y-m-d  H:i:s')
            ]);
            return response([
                'success' => true,
                'message' => 'verifikasi berhasil'
            ], 200);
        } else {
            return response([
                'success' => true,
                'message' => 'verifikasi gagal'
            ], 400);
        }
    }
}
