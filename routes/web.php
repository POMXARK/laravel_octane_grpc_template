<?php

use App\Http\Controllers\GrpcController;
use Illuminate\Support\Facades\Route;
use Rebing\GraphQL\Support\Facades\GraphQL;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/say-hello/{name}', [GrpcController::class, 'sayHello']);

Route::post('/graphql', function () {
    return GraphQL::executeQuery(request()->input('query'));
});4
