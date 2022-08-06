<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Save_model;
use Illuminate\Http\Request;

class Save_api extends Controller
{
    public function show(Request $request)
    {
        return response([
            'success' => true,
            'message' => Save_model::where('user_id', $request->user_id)->get()
        ], 200);
    }
    public function destroy(Request $request)
    {
        $validation = Validator($request->all(), [
            'type' => 'required',
            // 'user_id' => 'required',
            // 'id' => 'required'
        ]);
        $validationUser = Validator($request->all(), [
            'user_id' => 'required',
            // 'id' => 'required'
        ]);
        $validationById = Validator($request->all(), [
            // 'user_id' => 'required',
            'id' => 'required'
        ]);
        if ($validation->fails()) {
            return response([
                'success' => false,
                'message' => $validation->errors()
            ], 400);
        }
        // hapus save by user_id
        // semua yang di dalam save  by user_id
        if ($request->type == 'all') {
            if ($validationUser->fails()) {
                return response([
                    'success' => false,
                    'message' => $validationUser->errors()
                ], 400);
            }
            return response([
                'success' => true,
                'message' => 'hapus semua data berhasil'
            ], 200);
            Save_model::where('user_id', $request->user_id)->get();
        } else if ($request->type == 'byid') {
            if ($validationById->fails()) {
                return response([
                    'success' => false,
                    'message' => $validationById->errors()
                ], 400);
            }
            return response([
                'success' => true,
                'message' => 'hapus data berhasil'
            ], 200);
            Save_model::where('id', $request->id)->get();
        }
    }
}
