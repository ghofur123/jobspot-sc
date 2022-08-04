<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Upload_files_model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class Upload_files extends Controller
{
    public function index(Request $request)
    {
        return response([
            'success' => true,
            'data' => Upload_files_model::all()
        ], 200);
    }
    public function show(Request $request)
    {
        return response([
            'success' => true,
            'message' => 'valid',
            'data' => Upload_files_model::where('id_file_uplods', $request->id)->first()
        ], 200);
    }
    public function store(Request $request)
    {
        // $validation = validator($request->all(), [
        //     'file' => 'required|mimes:png,jpg,jpeg,gif',
        //     'id_lowongan' => 'required'
        // ]);
        // // check validation
        // if ($validation->fails()) {
        //     return response([
        //         'success' => false,
        //         'message' => $validation->errors()
        //     ], 400);
        // }
        // // menyimpan ke valiable $file
        // $file = $request->file('file');
        // $fileName = uniqid() . $file->getClientOriginalName();
        // Upload_files_model::insert([
        //     'id_lowongan' => $request->id_lowongan,
        //     'name' => $fileName,
        //     'ext_name' => $file->getClientOriginalExtension(),
        //     'type' => $file->getMimeType(),
        //     'size' => $file->getSize(),
        //     'path' => $file->getRealPath(),
        //     'url' => URL::asset('uploads/')
        // ]);
        // $file->move('uploads', $fileName);
        // return response([
        //     'success' => true,
        //     'message' => 'data di simpan',
        // ], 200);
    }
    public function update()
    {
    }
    public function destroy(Request $request)
    {
        // $message = array(
        //     'required' => ':attribute tidak boleh kosong'
        // );
        // $validation = validator($request->all(), [
        //     'id_file_uplods' => 'required'
        // ], $message);
        // // check validation
        // if ($validation->fails()) {
        //     $db = Upload_files_model::where('id_file_uplods', $request->id_file_uplods)
        //         ->first();
        //     // File::delete('uploads/' . $db->name);
        //     Upload_files_model::where([
        //         'id_file_uplods' => $request->id_file_uplods
        //     ])->delete();
        //     // cek file ada apa tidak di dalam folder
        //     if (file_exists('uploads/' . $db->name)) {
        //         unlink('uploads/' . $db->name);
        //         $response = response([
        //             'success' => true,
        //             'message' => 'data berhasil di hapus1'
        //         ], 200);
        //     } else {
        //         $response = response([
        //             'success' => true,
        //             'message' => 'data berhasil di hapus'
        //         ], 200);
        //     }
        // } else {
        //     $response = response([
        //         'success' => false,
        //         'message' => $validation->errors()
        //     ], 400);
        // }
        // return $response;
    }
}
