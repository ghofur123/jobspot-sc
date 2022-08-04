<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Wilayah_api extends Controller
{
    public function index()
    {
    }
    public function provinsi(Request $request)
    {
        $get = Http::get('https://emsifa.github.io/api-wilayah-indonesia/api/provinces.json');
        return $get->json();
    }
    public function kabupaten_kota(Request $request)
    {
        $get = Http::get('https://emsifa.github.io/api-wilayah-indonesia/api/regencies/' . $request->id . '.json');
        return $get->json();
    }
    public function kecamatan(Request $request)
    {
        $get = Http::get('http://www.emsifa.com/api-wilayah-indonesia/api/districts/' . $request->id . '.json');
        return $get->json();
    }
}
