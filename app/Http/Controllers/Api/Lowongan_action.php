<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Lowongan_model;
use Illuminate\Http\Request;

class Lowongan_action extends Controller
{
    public function search(Request $request)
    {
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
    public function by_id(Request $request)
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
        ]);
    }
}
