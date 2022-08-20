<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\IndustriRequest;
use App\Model\Industri;
use Illuminate\Http\Request;

class IndustriController extends Controller
{
    public function index()
    {
        return response([
            'status' => true,
            'message' => 'valid token',
            'data' => Industri::all()
        ]);
    }
    public function show(Request $request)
    {
        return response([
            'status' => true,
            'message' => 'valid token',
            'data' => Industri::where([
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

        $industri = Industri::insert([
            'nama' => $request->nama,
        ]);
        if ($industri) {
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
        $industri = Industri::where([
            'id' => $request->id,
        ])->update([
            'nama' => $request->nama,
        ]);
        if ($industri) {
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
        $industri = Industri::where([
            'id' => $request->id
        ])->delete();
        if ($industri) {
            return response([
                'delete' => 'success'
            ]);
        }
    }
}
