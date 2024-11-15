<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\AttendanceController;

Route::get('/', [EmployeeController::class,'dokumentasi'])->name('karyawan.dokumentasi');

Route::get('/karyawan', [EmployeeController::class,'index'])->name('karyawan');
Route::get('/karyawan/data', [EmployeeController::class,'data'])->name('karyawan.data');
Route::post('/karyawan/post-data', [EmployeeController::class,'postData'])->name('karyawan.postData');
Route::put('/karyawan/edit-data/{id}', [EmployeeController::class,'editData'])->name('karyawan.editData');
Route::post('/karyawan/absen-masuk/{id}', [EmployeeController::class,'absenMasuk'])->name('karyawan.absenMasuk');
Route::put('/karyawan/absen-keluar/{id}', [EmployeeController::class,'absenKeluar'])->name('karyawan.absenKeluar');
Route::delete('/karyawan/delete-data/{id}', [EmployeeController::class,'deleteData'])->name('karyawan.deleteData');


Route::get('/departement', [DepartementController::class,'index'])->name('departement');
Route::get('/departement/data', [DepartementController::class,'data'])->name('departement.data');
Route::post('/departement/post-data', [DepartementController::class,'postData'])->name('departement.postData');
Route::put('/departement/edit-data/{id}', [DepartementController::class,'editData'])->name('departement.editData');
Route::delete('/departement/delete-data/{id}', [DepartementController::class,'deleteData'])->name('departement.deleteData');


Route::get('/attendance', [AttendanceController::class,'index'])->name('attendance');
Route::get('/attendance/data', [AttendanceController::class,'data'])->name('attendance.data');