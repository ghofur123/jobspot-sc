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
        $validation = Validator($request->all(), [
            'lowongan_id' => 'required'
        ]);
        if ($validation->fails()) {
            return response([
                'success' => false,
                'message' => $validation->errors()
            ]);
        }
        return response([
            'success' => true,
            'message' => 'valid',
            'data' => Upload_files_model::where('lowongan_id', $request->id)->first()
        ], 200);
    }
    public function store(Request $request)
    {
        $validation = validator($request->all(), [
            'file' => 'required|mimes:png,jpg,jpeg,gif',
            'lowongan_id' => 'required'
        ]);
        // check validation
        if ($validation->fails()) {
            return response([
                'success' => false,
                'message' => $validation->errors()
            ], 400);
        }
        // // menyimpan ke valiable $file
        $file = $request->file('file');
        $fileName = uniqid() . $file->getClientOriginalName();
        Upload_files_model::insert([
            'lowongan_id' => $request->lowongan_id,
            'name' => $fileName,
            'ext_name' => $file->getClientOriginalExtension(),
            'type' => $file->getMimeType(),
            'size' => $file->getSize(),
            'path' => $file->getRealPath(),
            'url' => URL::asset('uploads/')
        ]);
        $file->move('../uploads', $fileName);
        return response([
            'success' => true,
            'message' => 'data di simpan',
        ], 200);
    }
    public function update()
    {
    }
    public function destroy(Request $request)
    {
        $validation = validator($request->all(), [
            'id' => 'required'
        ]);
        // check validation
        if ($validation->fails()) {
            return response([
                'success' => false,
                'message' => $validation->errors()
            ], 400);
        }
        $db =  Upload_files_model::where('id', $request->id)->first();
        // File::delete('uploads/' . $db->name);
        Upload_files_model::where([
            'id' => $request->id
        ])->delete();
        if (file_exists('../uploads/' . $db->name)) {
            unlink('../uploads/' . $db->name);
            return response([
                'success' => true,
                'message' => 'data berhasil di hapus'
            ], 200);
        } else {
            return response([
                'success' => true,
                'message' => 'data gagal di hapus'
            ], 400);
        }
    }
}
