<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Tipe_pekerjaan_model;
use Illuminate\Http\Request;

class Tipe_pekerjaan extends Controller
{
    public function index()
    {
        return response([
            'status' => true,
            'message' => 'valid token',
            'data' => Tipe_pekerjaan_model::all()
        ]);
    }
    public function show(Request $request)
    {
        return response([
            'status' => true,
            'message' => 'valid token',
            'data' => Tipe_pekerjaan_model::where([
                'id' => $request->id
            ])->get()
        ]);
    }
    public function store(Request $request)
    {
        $validation = Validator($request->all(), [
            'nama' => 'required',
        ]);
        if ($validation->fails()) {
            return response([
                'status' => false,
                'validation' => $validation->errors()
            ]);
        }
        $data = Tipe_pekerjaan_model::insert([
            'nama' => $request->nama,
        ]);
        if ($data) {
            return response([
                'inserting' => 'success'
            ]);
        }
    }
    public function update(Request $request)
    {
        $validation = Validator($request->all(), [
            'nama' => 'required',
        ]);
        if ($validation->fails()) {
            return response([
                'status' => false,
                'validation' => $validation->errors()
            ]);
        }
        $data = Tipe_pekerjaan_model::where([
            'id' => $request->id,
        ])->update([
            'nama' => $request->nama,
        ]);
        if ($data) {
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
        $data = Tipe_pekerjaan_model::where([
            'id' => $request->id
        ])->delete();
        if ($data) {
            return response([
                'delete' => 'success'
            ]);
        }
    }
}
