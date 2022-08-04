<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class Users_api extends Controller
{
    // level 
    // 1 = worker
    // 2 = recruter
    // 3 = admin
    public function index()
    {
        return response([
            'status' => true,
            'message' => 'valid token',
            'data' => User::all()
        ]);
    }
    public function show(Request $request)
    {
        return response([
            'status' => true,
            'message' => 'valid token',
            'data' => User::where([
                'id' => $request->id
            ])->get()
        ]);
    }
    public function store(Request $request)
    {
        $validation = Validator($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'level' => 'required'
        ]);
        if ($validation->fails()) {
            return response([
                'status' => false,
                'validation' => $validation->errors()
            ]);
        }
        $user = User::insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => sha1($request->password),
            'remember_token' => sha1($request->email),
            'level' => $request->level,
        ]);
        if ($user) {
            // kirim email verifikasi
            Mail::to($request->email)->send(new \App\Mail\Users_verified(sha1($request->email)));
            return response([
                'inserting' => 'success'
            ]);
        }
    }
    public function update(Request $request)
    {
        $validation = Validator($request->all(), [
            'id' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        if ($validation->fails()) {
            return response([
                'status' => false,
                'validation' => $validation->errors()
            ]);
        }
        $user = User::where([
            'id' => $request->id
        ])->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'remember_token' => sha1($request->email)
        ]);
        if ($user) {
            return response([
                'updating' => 'success'
            ]);
        }
    }
    public function destroy(Request $request)
    {
        $validation = Validator($request->all(), [
            'id' => 'required'
        ]);
        if ($validation->fails()) {
            return response([
                'status' => false,
                'validation' => $validation->errors()
            ]);
        }
        $user = User::where([
            'id' => $request->id
        ])->delete();
        if ($user) {
            return response([
                'delete' => 'success'
            ]);
        }
    }
}
