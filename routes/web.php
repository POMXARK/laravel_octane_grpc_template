<?php

use App\Http\Controllers\GrpcController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/say-hello/{name}', [GrpcController::class, 'sayHello']);
