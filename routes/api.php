<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::middleware('auth:sanctum')->group(function () {
    // Users_api 
    Route::get('/users', 'Api\Users_api@index');
    Route::get('/users/{id}', 'Api\Users_api@show');
    Route::put('/users', 'Api\Users_api@update');
    Route::delete('/users', 'Api\Users_api@destroy');

    // industri
    Route::get('/industri', 'Api\Industri_api@index');
    Route::get('/industri/{id}', 'Api\Industri_api@show');
    Route::post('/industri', 'Api\Industri_api@store');
    Route::put('/industri', 'Api\Industri_api@update');
    Route::delete('/industri', 'Api\Industri_api@destroy');

    // pendidikan
    Route::get('/pendidikan', 'Api\Pendidikan_api@index');
    Route::get('/pendidikan/{id}', 'Api\Pendidikan_api@show');
    Route::post('/pendidikan', 'Api\Pendidikan_api@store');
    Route::put('/pendidikan', 'Api\Pendidikan_api@update');
    Route::delete('/pendidikan', 'Api\Pendidikan_api@destroy');

    // pendidikan
    Route::get('/typepe', 'Api\Tipe_pekerjaan@index');
    Route::get('/typepe/{id}', 'Api\Tipe_pekerjaan@show');
    Route::post('/typepe', 'Api\Tipe_pekerjaan@store');
    Route::put('/typepe', 'Api\Tipe_pekerjaan@update');
    Route::delete('/typepe', 'Api\Tipe_pekerjaan@destroy');

    // upload files
    Route::get('/upload', 'Api\Upload_files@index');
    Route::get('/upload/{id}', 'Api\Upload_files@show');
    Route::post('/upload', 'Api\Upload_files@store');
    Route::put('/upload', 'Api\Upload_files@update');
    Route::delete('/upload', 'Api\Upload_files@destroy');

    // save
    // save lowongan by user id
    Route::get('/save/{user_id}', 'Api\Save_api@show');
    // all = hapus semua sesuai user_id
    // byid = sesuai dengan id yang di hapus
    Route::delete('/save', 'Api\Save_api@destroy');


    // lowongan
    Route::get('/lowongan', 'Api\Lowongan_Api@index');
    Route::get('/lowongan/{id}', 'Api\Lowongan_Api@show');
    Route::post('/lowongan', 'Api\Lowongan_Api@store');
    Route::put('/lowongan', 'Api\Lowongan_Api@update');
    Route::delete('/lowongan', 'Api\Lowongan_Api@destroy');
});
// Users_api 
Route::post('/users', 'Api\Users_api@store');
// Users_mail 
Route::get('/verifiedmail/{token}', 'Api\Users_mail@verified');
Route::post('/resetpass', 'Api\Users_mail@reset_password');
// login
Route::post('/login', 'Api\Login_users@login');

// wilayah
Route::get('/provinsi', 'Api\Wilayah_api@provinsi');
Route::get('/kabupaten', 'Api\Wilayah_api@kabupaten_kota');
Route::get('/kecamatan', 'Api\Wilayah_api@kecamatan');

// lowongan action
Route::get('/loker/{id}/{title}', 'Api\Lowongan_action@by_id');
Route::get('/search/{title}', 'Api\Lowongan_action@search');
