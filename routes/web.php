<?php

use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('pegawai', [EmployeeController::class, 'index'])->name('pegawai');
Route::get('pegawai/export-pdf', [EmployeeController::class, 'export'])->name('export.pdf');
Route::get('pegawai/export-excel', [EmployeeController::class, 'excel'])->name('export.excel');
Route::get('pegawai/add-pegawai', [EmployeeController::class, 'create'])->name('add.pegawai');
Route::post('pegawai/store-pegawai', [EmployeeController::class, 'store'])->name('store.pegawai');
Route::get('pegawai/edit-pegawai/{id}', [EmployeeController::class, 'edit'])->name('edit.pegawai');
Route::put('pegawai/update-pegawai/{id}', [EmployeeController::class, 'update'])->name('update.pegawai');
Route::get('pegawai/delete-pegawai/{id}', [EmployeeController::class, 'delete'])->name('delete.pegawai');
