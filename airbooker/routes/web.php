<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', function () {
    return view('admin', ['name' => 'Airbooker']);
});
