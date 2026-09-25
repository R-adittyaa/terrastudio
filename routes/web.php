<?php

use Illuminate\Support\Facades\Route;

// Halaman Utama untuk Pembaca Umum
Route::get('/', function () {
    return view('welcome');
});

// Halaman Rahasia Studio Admin khusus Obet
Route::get('/workspace-studio', function () {
    return view('admin');
});