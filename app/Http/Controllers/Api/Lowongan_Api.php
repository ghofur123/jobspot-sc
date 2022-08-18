<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Lowongan;
use App\Model\Lowongan_model;
use Illuminate\Http\Request;

class Lowongan_Api extends Controller
{
    public function index()
    {
        $db = Lowongan_model
            ::join('pendidikan', 'lowongan.pendidikan_id', '=', 'pendidikan.id')
            ->join('tipe_pekerjaan', 'lowongan.tipe_pekerjaan_id', '=', 'tipe_pekerjaan.id')
            ->join('bidang_pekerjaan', 'lowongan.bidang_pekerjaan_id', '=', 'bidang_pekerjaan.id')
            ->join('industri', 'lowongan.industri_id', '=', 'industri.id')
            ->join('users', 'lowongan.users_id', '=', 'users.id')
            ->select('lowongan.id', 'lowongan.nama_perusahaan', 'lowongan.title', 'lowongan.kualifikasi', 'pendidikan.nama AS pendidikan', 'lowongan.status_kerja', 'tipe_pekerjaan.nama AS tipe_pekerjaan', 'lowongan.gaji', 'bidang_pekerjaan.title', 'industri.nama AS industri', 'lowongan.lokasi_kerja', 'lowongan.deskripsi', 'lowongan.syarat', 'lowongan.benefit', 'users.name AS user')
            ->get();
        return response([
            'success' => true,
            'data' => $db
        ]);
    }
    public function show(Request $request)
    {
        $db = Lowongan_model
            ::join('pendidikan', 'lowongan.pendidikan_id', '=', 'pendidikan.id')
            ->join('tipe_pekerjaan', 'lowongan.tipe_pekerjaan_id', '=', 'tipe_pekerjaan.id')
            ->join('bidang_pekerjaan', 'lowongan.bidang_pekerjaan_id', '=', 'bidang_pekerjaan.id')
            ->join('industri', 'lowongan.industri_id', '=', 'industri.id')
            ->join('users', 'lowongan.users_id', '=', 'users.id')
            ->select('lowongan.id', 'lowongan.nama_perusahaan', 'lowongan.title', 'lowongan.kualifikasi', 'pendidikan.nama AS pendidikan', 'lowongan.status_kerja', 'tipe_pekerjaan.nama AS tipe_pekerjaan', 'lowongan.gaji', 'bidang_pekerjaan.title', 'industri.nama AS industri', 'lowongan.lokasi_kerja', 'lowongan.deskripsi', 'lowongan.syarat', 'lowongan.benefit', 'users.name AS user')
            ->where([
                'lowongan.id' => $request->id
            ])
            ->get();
        return response([
            'success' => true,
            'data' => $db
        ], 200);
    }
    public function store(Request $request)
    {
        $validation = validator($request->all(), [
            'nama_perusahaan' => 'required',
            'title' => 'required',
            'kualifikasi' => 'required',
            'pendidikan_id' => 'required',
            'status_kerja' => 'required',
            'tipe_pekerjaan_id' => 'required',
            'gaji' => 'required|numeric',
            'bidang_pekerjaan_id' => 'required',
            'industri_id' => 'required',
            'lokasi_kerja' => 'required',
            'deskripsi' => 'required',
            'syarat' => 'required',
            'benefit' => 'required',
            'users_id' => 'required'

        ]);
        if ($validation->fails()) {
            return response([
                'success' => true,
                'message' => $validation->errors()
            ], 200);
        }
        $db = Lowongan_model::insert([
            'nama_perusahaan' => $request->nama_perusahaan,
            'title' => $request->title,
            'kualifikasi' => $request->kualifikasi,
            'pendidikan_id' => $request->pendidikan_id,
            'status_kerja' => $request->status_kerja,
            'tipe_pekerjaan_id' => $request->tipe_pekerjaan_id,
            'gaji' => $request->gaji,
            'bidang_pekerjaan_id' => $request->bidang_pekerjaan_id,
            'industri_id' => $request->industri_id,
            'lokasi_kerja' => $request->lokasi_kerja,
            'deskripsi' => $request->deskripsi,
            'syarat' => $request->syarat,
            'benefit' => $request->benefit,
            'users_id' => $request->users_id
        ]);
        if (!$db) {
            return response([
                'success' => false,
                'message' => 'data not save',
            ], 200);
        }
        return response([
            'success' => true,
            'message' => 'data di simpan',
        ], 200);
    }
    public function update(Request $request)
    {
        $validation = validator($request->all(), [
            'nama_perusahaan' => 'required',
            'title' => 'required',
            'kualifikasi' => 'required',
            'pendidikan_id' => 'required',
            'status_kerja' => 'required',
            'tipe_pekerjaan_id' => 'required',
            'gaji' => 'required|numeric',
            'bidang_pekerjaan_id' => 'required',
            'industri_id' => 'required',
            'lokasi_kerja' => 'required',
            'deskripsi' => 'required',
            'syarat' => 'required',
            'benefit' => 'required',
            'users_id' => 'required'

        ]);
        if ($validation->fails()) {
            return response([
                'success' => true,
                'message' => $validation->errors()
            ], 200);
        }
        $db = Lowongan_model::where([
            'id' => $request->id
        ])->update([
            'nama_perusahaan' => $request->nama_perusahaan,
            'title' => $request->title,
            'kualifikasi' => $request->kualifikasi,
            'pendidikan_id' => $request->pendidikan_id,
            'status_kerja' => $request->status_kerja,
            'tipe_pekerjaan_id' => $request->tipe_pekerjaan_id,
            'gaji' => $request->gaji,
            'bidang_pekerjaan_id' => $request->bidang_pekerjaan_id,
            'industri_id' => $request->industri_id,
            'lokasi_kerja' => $request->lokasi_kerja,
            'deskripsi' => $request->deskripsi,
            'syarat' => $request->syarat,
            'benefit' => $request->benefit,
            'users_id' => $request->users_id
        ]);
        if ($db) {
            return response([
                'success' => true,
                'message' => 'data di update',
            ], 200);
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
        $industri = Lowongan_model::where([
            'id' => $request->id
        ])->delete();
        if ($industri) {
            return response([
                'delete' => 'success'
            ]);
        }
    }
}
