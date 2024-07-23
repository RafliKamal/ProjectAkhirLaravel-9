<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectAkhirController;
use App\Http\Controllers\LoginController;
use Barryvdh\DomPDF\Facade as PDF;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\PDFController;





// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/404', function () {
//     return view('error-404');
// });

// //Project Akhir
    Route::get('/template', [ProjectAkhirController::class, 'template']);
    Route::get('/master', [ProjectAkhirController::class, 'master']);
// Route::get('/projectakhir', [ProjectAkhirController::class, 'index'])->name  

// // // Membutuhkan autentikasi untuk dashboard
// // Route::get('/dashboard', [ProjectAkhirController::class, 'dashboard'])->middleware('auth');


// Route::get('/login', [LoginController::class, 'index']);
// Route::post('/login', [LoginController::class, 'login']);
// Route::get('/logout', [LoginController::class, 'logout']);


// // // Routes Login dan Logout
// // Route::get('/login', [LoginController::class, 'index'])->name('login');
// // Route::post('/login', [LoginController::class, 'login']);
// // Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');

// //Untuk Semua role
// Route::get('/lihatUjian', [ProjectAkhirController::class, 'ujian']);
// Route::get('/lihatUjian2/{ujian_id}', [ProjectAkhirController::class, 'ujian2']);
// // Route::get('/lihatUjian2/{ujian_id}', [PDFController::class, 'generatePDF']);


// //hanya Admin
// Route::get('/tbUser', [ProjectAkhirController::class, 'tbUser']);
// Route::get('/cariUser', [ProjectAkhirController::class, 'cariUser']);
// Route::post('/simpanUser', [ProjectAkhirController::class, 'tambahUser']);
// Route::post('/editUser', [ProjectAkhirController::class, 'editUser'])   ;
// Route::get('/hapusUser/{user_id}', [ProjectAkhirController::class, 'hapusUser']);

// Route::get('/tbMatkul', [ProjectAkhirController::class, 'tbMatkul']);
// Route::post('/simpanMatkul', [ProjectAkhirController::class, 'tambahMatkul']);
// Route::post('/updateMatkul', [ProjectAkhirController::class, 'updateMatkul']);
// Route::get('/hapusMatkul/{matkul_id}', [ProjectAkhirController::class, 'hapusMatkul']);

// Route::get('/tbProdi', [ProjectAkhirController::class, 'tbProdi']);
// Route::post('/simpanProdi', [ProjectAkhirController::class, 'tambahProdi']);
// Route::get('/editProdi/{prodi_id}', [ProjectAkhirController::class, 'editProdi']);
// Route::post('/updateProdi/{prodi_id}', [ProjectAkhirController::class, 'updateProdi']);
// Route::get('/hapusProdi/{prodi_id}', [ProjectAkhirController::class, 'hapusProdi']);


// Route::get('/tbSoal', [ProjectAkhirController::class, 'tbSoal']);
// Route::get('/tbUjian', [ProjectAkhirController::class, 'tbUjian']);


// //Untuk role selain Mahasiswa
// Route::get('/dashboard', [ProjectAkhirController::class, 'dashboard']);

// Route::get('/BuatSoal', [ProjectAkhirController::class, 'buatSoal']);
// Route::get('/BankSoal', [ProjectAkhirController::class, 'bankSoal']);
// Route::post('/simpanSoal', [ProjectAkhirController::class, 'simpanSoal']);
// Route::post('/updateSoal', [ProjectAkhirController::class, 'updateSoal']);
// Route::post('/updateSoal2', [ProjectAkhirController::class, 'updateSoal2']);
// Route::get('/hapusSoal/{soal_id}', [ProjectAkhirController::class, 'hapusSoal']);
// Route::get('/hapusSoal2/{soal_id}', [ProjectAkhirController::class, 'hapusSoal2']);
// Route::get('/getSoalByMatkul/{matkulId}', [ProjectAkhirController::class, 'getSoalByMatkul']);


// Route::get('/BuatUjian', [ProjectAkhirController::class, 'buatUjian']);
// Route::post('/BuatUjian2', [ProjectAkhirController::class, 'buatUjian2']);
// Route::post('/simpanUjian', [ProjectAkhirController::class, 'simpanUjian']);
// Route::get('/hapusUjian/{ujian_id}', [ProjectAkhirController::class, 'hapusUjian']);

// Route::get('/revisiUjian/{ujian_id}', [ProjectAkhirController::class, 'revisiUjian']);
// Route::post('/simpanRevisi', [ProjectAkhirController::class, 'simpanRevisi']);

// //Hanya untuk role Kaprodi dan Admin
// Route::get('/ReviewUjian', [ProjectAkhirController::class, 'ReviewUjian']);
// Route::get('/ReviewUjian2/{ujian_id}', [ProjectAkhirController::class, 'ReviewUjian2']);
// Route::post('/simpanReview/{ujian_id}', [ProjectAkhirController::class, 'simpanReview']);



Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout']);

Route::get('/404', function () {
    return view('error-404');
});

// Untuk Semua role

Route::get('/lihatUjian', [ProjectAkhirController::class, 'ujian'])->middleware('auth');
Route::get('/lihatUjian2/{ujian_id}', [ProjectAkhirController::class, 'ujian2'])->middleware('auth');


// Hanya Admin
Route::group(['middleware' => 'akses-user:Admin'], function(){
    Route::get('/tbUser', [ProjectAkhirController::class, 'tbUser']);
    Route::get('/cariUser', [ProjectAkhirController::class, 'cariUser']);
    Route::post('/simpanUser', [ProjectAkhirController::class, 'tambahUser']);
    Route::post('/editUser', [ProjectAkhirController::class, 'editUser']);
    Route::get('/hapusUser/{user_id}', [ProjectAkhirController::class, 'hapusUser']);

    Route::get('/tbMatkul', [ProjectAkhirController::class, 'tbMatkul']);
    Route::post('/simpanMatkul', [ProjectAkhirController::class, 'tambahMatkul']);
    Route::post('/updateMatkul', [ProjectAkhirController::class, 'updateMatkul']);
    Route::get('/hapusMatkul/{matkul_id}', [ProjectAkhirController::class, 'hapusMatkul']);

    Route::get('/tbProdi', [ProjectAkhirController::class, 'tbProdi']);
    Route::post('/simpanProdi', [ProjectAkhirController::class, 'tambahProdi']);
    Route::get('/editProdi/{prodi_id}', [ProjectAkhirController::class, 'editProdi']);
    Route::post('/updateProdi/{prodi_id}', [ProjectAkhirController::class, 'updateProdi']);
    Route::get('/hapusProdi/{prodi_id}', [ProjectAkhirController::class, 'hapusProdi']);

    Route::get('/tbSoal', [ProjectAkhirController::class, 'tbSoal']);
    Route::get('/tbUjian', [ProjectAkhirController::class, 'tbUjian']);
});

// Untuk role selain Mahasiswa
Route::group(['middleware' => 'akses-user:Admin,Dosen,Kaprodi'], function(){
    Route::get('/dashboard', [ProjectAkhirController::class, 'dashboard']);
    Route::get('/cariUjian1', [ProjectAkhirController::class, 'cariUjian1']);

    Route::get('/BuatSoal', [ProjectAkhirController::class, 'buatSoal']);
    Route::get('/BankSoal', [ProjectAkhirController::class, 'bankSoal']);
    Route::post('/simpanSoal', [ProjectAkhirController::class, 'simpanSoal']);
    Route::post('/updateSoal', [ProjectAkhirController::class, 'updateSoal']);
    Route::post('/updateSoal2', [ProjectAkhirController::class, 'updateSoal2']);
    Route::get('/hapusSoal/{soal_id}', [ProjectAkhirController::class, 'hapusSoal']);
    Route::get('/hapusSoal2/{soal_id}', [ProjectAkhirController::class, 'hapusSoal2']);
    Route::get('/getSoalByMatkul/{matkulId}', [ProjectAkhirController::class, 'getSoalByMatkul']);

    Route::get('/BuatUjian', [ProjectAkhirController::class, 'buatUjian']);
    Route::post('/BuatUjian2', [ProjectAkhirController::class, 'buatUjian2']);
    Route::post('/simpanUjian', [ProjectAkhirController::class, 'simpanUjian']);
    Route::get('/hapusUjian/{ujian_id}', [ProjectAkhirController::class, 'hapusUjian']);

    Route::get('/revisiUjian/{ujian_id}', [ProjectAkhirController::class, 'revisiUjian']);
    Route::post('/simpanRevisi', [ProjectAkhirController::class, 'simpanRevisi']);
});

// Hanya untuk role Kaprodi dan Admin
Route::group(['middleware' => 'akses-user:Admin,Kaprodi'], function(){
    Route::get('/ReviewUjian', [ProjectAkhirController::class, 'ReviewUjian']);
    Route::get('/ReviewUjian2/{ujian_id}', [ProjectAkhirController::class, 'ReviewUjian2']);
    Route::post('/simpanReview/{ujian_id}', [ProjectAkhirController::class, 'simpanReview']);
});
