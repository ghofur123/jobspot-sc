<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Lowongan_model;
use Illuminate\Http\Request;

class LowonganActionController extends Controller
{
    public function by_id(Request $request)
    {
        $validation = validator($request->all(), [
            'id' => 'required'
        ]);
        if ($validation->fails()) {
            return response([
                'success' => false,
                'message' => $validation->errors()
            ], 200);
        }
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
        ]);
    }
    public function search(Request $request)
    {
        $validation = validator($request->all(), [
            'title' => 'required'
        ]);
        if ($validation->fails()) {
            return response([
                'success' => false,
                'message' => $validation->errors()
            ], 200);
        }
        $db = Lowongan_model
            ::join('pendidikan', 'lowongan.pendidikan_id', '=', 'pendidikan.id')
            ->join('tipe_pekerjaan', 'lowongan.tipe_pekerjaan_id', '=', 'tipe_pekerjaan.id')
            ->join('bidang_pekerjaan', 'lowongan.bidang_pekerjaan_id', '=', 'bidang_pekerjaan.id')
            ->join('industri', 'lowongan.industri_id', '=', 'industri.id')
            ->join('users', 'lowongan.users_id', '=', 'users.id')
            ->select('lowongan.id', 'lowongan.nama_perusahaan', 'lowongan.title', 'lowongan.kualifikasi', 'pendidikan.nama AS pendidikan', 'lowongan.status_kerja', 'tipe_pekerjaan.nama AS tipe_pekerjaan', 'lowongan.gaji', 'bidang_pekerjaan.title', 'industri.nama AS industri', 'lowongan.lokasi_kerja', 'lowongan.deskripsi', 'lowongan.syarat', 'lowongan.benefit', 'users.name AS user')
            ->where(
                'lowongan.title',
                'LIKE',
                '%' . $request->title . '%'
            )
            ->get();
        return response([
            'success' => true,
            'data' => $db
        ]);
    }
    public function lokasi(Request $request)
    {
        $validation = validator($request->all(), [
            'lokasi' => 'required'
        ]);
        if ($validation->fails()) {
            return response([
                'success' => false,
                'message' => $validation->errors()
            ], 200);
        }
        $db = Lowongan_model
            ::join('pendidikan', 'lowongan.pendidikan_id', '=', 'pendidikan.id')
            ->join('tipe_pekerjaan', 'lowongan.tipe_pekerjaan_id', '=', 'tipe_pekerjaan.id')
            ->join('bidang_pekerjaan', 'lowongan.bidang_pekerjaan_id', '=', 'bidang_pekerjaan.id')
            ->join('industri', 'lowongan.industri_id', '=', 'industri.id')
            ->join('users', 'lowongan.users_id', '=', 'users.id')
            ->select('lowongan.id', 'lowongan.nama_perusahaan', 'lowongan.title', 'lowongan.kualifikasi', 'pendidikan.nama AS pendidikan', 'lowongan.status_kerja', 'tipe_pekerjaan.nama AS tipe_pekerjaan', 'lowongan.gaji', 'bidang_pekerjaan.title', 'industri.nama AS industri', 'lowongan.lokasi_kerja', 'lowongan.deskripsi', 'lowongan.syarat', 'lowongan.benefit', 'users.name AS user')
            ->where([
                'lowongan.lokasi_kerja' => $request->lokasi
            ])
            ->get();
        return response([
            'success' => true,
            'data' => $db
        ]);
    }
    public function bidang_pekerjaan(Request $request)
    {
        $validation = validator($request->all(), [
            'bidang_pekerjaan' => 'required'
        ]);
        if ($validation->fails()) {
            return response([
                'success' => false,
                'message' => $validation->errors()
            ], 400);
        }
        $db = Lowongan_model
            ::join('pendidikan', 'lowongan.pendidikan_id', '=', 'pendidikan.id')
            ->join('tipe_pekerjaan', 'lowongan.tipe_pekerjaan_id', '=', 'tipe_pekerjaan.id')
            ->join('bidang_pekerjaan', 'lowongan.bidang_pekerjaan_id', '=', 'bidang_pekerjaan.id')
            ->join('industri', 'lowongan.industri_id', '=', 'industri.id')
            ->join('users', 'lowongan.users_id', '=', 'users.id')
            ->select('lowongan.id', 'lowongan.nama_perusahaan', 'lowongan.title', 'lowongan.kualifikasi', 'pendidikan.nama AS pendidikan', 'lowongan.status_kerja', 'tipe_pekerjaan.nama AS tipe_pekerjaan', 'lowongan.gaji', 'bidang_pekerjaan.title', 'industri.nama AS industri', 'lowongan.lokasi_kerja', 'lowongan.deskripsi', 'lowongan.syarat', 'lowongan.benefit', 'users.name AS user')
            ->where([
                'lowongan.bidang_pekerjaan_id' => $request->bidang_pekerjaan
            ])
            ->get();
        return response([
            'success' => true,
            'data' => $db
        ], 200);
    }
}
