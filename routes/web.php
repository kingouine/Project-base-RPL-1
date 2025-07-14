<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TugasController;
use App\Http\Controllers\EvaluasiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KehadiranController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

//welcome 
Route::get('/', action: function () {
    return view('welcome');
})->name('welcome');

//login
Route::get('login',[AuthController::class,'login'])->name('login');
Route::post('login',[AuthController::class,'loginProses'])->name('loginProses');
//logout
Route::get('logout',[AuthController::class,'logout'])->name('logout');


Route::middleware('checkLogin')-> group(function(){
//user
Route::get('user',[UserController::class,'index'])->name('user');
Route::get('user/create',[UserController::class,'create'])->name('userCreate');
Route::get('user/edit/{id}',[UserController::class,'edit'])->name('userEdit');
Route::post('user/store',[UserController::class,'store'])->name('userStore');
Route::post('user/update/{id}',[UserController::class,'update'])->name('userUpdate');
Route::delete('user/destroy/{id}',[UserController::class,'destroy'])->name('userDestroy');

Route::get('user/excel',[UserController::class,'excel'])->name('userExcel');
Route::get('user/pdf',[UserController::class,'pdf'])->name('userPdf');

//kehadiran Admin
Route::get('Kehadiran',[KehadiranController::class,'Kehadiran'])->name('Kehadiran');
Route::post('kehadiran/clock-in', [KehadiranController::class, 'clockIn'])->name('kehadiranClockIn');
Route::post('kehadiran/clock-out/{aten_id}', [KehadiranController::class, 'clockOut'])->name('kehadiranClockOut');
Route::delete('kehadiran/destroy/{aten_id}', [KehadiranController::class, 'destroy'])->name('kehadiranDestroy');

Route::get('kehadiran/excel',[KehadiranController::class,'excelKehadiran'])->name('userExcelKehadiran');
Route::get('kehadiran/pdf',[KehadiranController::class,'pdfKehadiran'])->name('userPdfKehadiran');

//kehdairan Manajer
Route::get('KehadiranManajer',[KehadiranController::class,'kehadiranManajer'])->name('kehadiranManajer');

//kehadiran karyawan
Route::get('KehadiranKaryawan',[KehadiranController::class,'kehadiranKaryawan'])->name('kehadiranKaryawan');

//tugas Karyawan
Route::get('tugasKaryawan',[TugasController::class,'tugasKaryawan'])->name('tugasKaryawan');

//tugas
Route::get('tugas',[TugasController::class,'index'])->name('tugas');
Route::get('tugas/create',[TugasController::class,'create'])->name('tugasCreate');
Route::get('tugas/edit/{id}',[TugasController::class,'edit'])->name('tugasEdit');
Route::post('tugas/update/{id}',[TugasController::class,'update'])->name('tugasUpdate');
Route::delete('tugas/destroy/{id}', [TugasController::class, 'destroy'])->name('tugasDestroy');
Route::post('tugas/store',[TugasController::class,'store'])->name('tugasStore');

Route::get('tugas/excel',[TugasController::class,'excelTugas'])->name('excelTugas');
Route::get('tugas/pdf',[TugasController::class,'pdfTugas'])->name('pdfTugas');

// Route untuk karyawan edit tugas
Route::get('tugasKaryawan', [TugasController::class, 'tugasKaryawan'])->name('tugasKaryawan');
Route::get('tugas/karyawan/edit/{id}', [TugasController::class, 'editTugasKaryawan'])->name('tugasKaryawanEdit');
Route::put('tugas/karyawan/update/{id}', [TugasController::class, 'updateTugasKaryawan'])->name('tugasKaryawanUpdate');

Route::get('evaluasi', [EvaluasiController::class, 'index'])->name('evaluasi');
Route::get('evaluasi/create', [EvaluasiController::class, 'create'])->name('evaluasiCreate');
Route::post('evaluasi/store', [EvaluasiController::class, 'store'])->name('evaluasiStore');
Route::get('evaluasi/edit/{id}', [EvaluasiController::class, 'edit'])->name('evaluasiEdit');
Route::put('evaluasi/update/{id}', [EvaluasiController::class, 'update'])->name('evaluasiUpdate');

//dashboard
Route::get('dashboard',[DashboardController::class,'index'])->name('dashboard');
});