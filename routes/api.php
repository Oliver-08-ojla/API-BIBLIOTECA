<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\PrestamoController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;


Route::post('/register', [UsuarioController::class, 'register']);
Route::post('/login', [UsuarioController::class, 'login']);

Route::middleware('auth:sanctum')->group( function () {
    //aquí ban todas las rutas pero como no está validado en angular por enden están agu
});
Route::resource('libros', LibroController::class);
Route::get('prestamos/libros/lend/{id}', [PrestamoController::class,'lendBook']);
Route::resource('clientes', ClienteController::class);
Route::resource('prestamos', PrestamoController::class);
Route::get('prestamos/libros/user/{id}', [PrestamoController::class,'bookLend']);
Route::get('prestamos/libros/admin', [PrestamoController::class,'booksLendAll']);


