<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\LibrosController;
use App\Http\Controllers\PrestamoController;
use App\Http\Controllers\UsuarioController;
use App\Models\Libro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/register', [UsuarioController::class, 'register']);
Route::post('/login', [UsuarioController::class, 'login']);

Route::middleware('auth:sanctum')->group( function () {
});
Route::resource('libros', LibroController::class);
Route::resource('clientes', ClienteController::class);
Route::resource('prestamos', PrestamoController::class);
Route::get('prestamos/libros/user/{id}', [PrestamoController::class,'bookLend']);


/* Route::group(
    ['middleware' => ["auth:sanctum"]],
    function () {
        Route::controller(UsuarioController::class)->group(function () {
            Route::get('userProfile', 'userProfile');
            Route::post('logout', 'logout');
        });
        Route::controller(PrestamoController::class)->group(function () {
            Route::get('prestamos', 'index');
            Route::get('prestamos/{id}', 'show');
            Route::post('prestamos', 'store');
            Route::post('devolver/{id}', 'devolverLibro');
            Route::get('listado', 'listado');
            Route::get('listadoUC', 'listadoUC');
        });
        
    }

);

Route::controller(UsuarioController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
});


Route::controller(LibroController::class)->group(function () {
    Route::get('libros', 'index');
    Route::get('libros/{id}', 'show');
    Route::post('libros', 'store');
    Route::put('libros/{id}', 'update');
    Route::delete('libros/{id}', 'destroy');
});

Route::controller(ClienteController::class)->group(function(){

    Route::get('clientes', 'index');
    Route::get('clientes/{id}', 'show');
    Route::post('clientes', 'store');
    Route::post('clientes/{id}', 'update');
    Route::delete('clientes/{id}', 'destroy');
}); */

