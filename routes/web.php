<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('users', UserController::class);

Route::group([], function() {

    Route::get('/usuarios', [UserController::class, 'index']);
        //->middleware('role:user.index');

    Route::get('/usuario/cadastrar', [UserController::class, 'create']);
        //->middleware('role:user.create');

    Route::post('/usuario', [UserController::class, 'insert']);
        //->middleware('role:user.create');

    Route::get('/usuario/{id}/editar', [UserController::class, 'edit']);
        //->middleware('role:user.update');

    Route::put('/usuario', [UserController::class, 'update']);
        //->middleware('role:user.index');

    Route::delete('/usuario', [UserController::class, 'delete']);
        //->middleware('role:user.delete');

});
