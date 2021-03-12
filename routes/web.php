<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlumnoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('mostrar', [AlumnoController::class, 'mostrar']);
Route::delete('borrar/{id_ropa}', [AlumnoController::class, 'borrar']);
Route::delete('borrarCart/{id}', [AlumnoController::class, 'borrarCart']);
Route::get('crear', [AlumnoController::class, 'crear']);
/*Route::get('verCarrito', [AlumnoController::class, 'verCarrito']);*/
Route::post('recibir', [AlumnoController::class, 'recibir']);
Route::get('actualizar/{id_ropa}', [AlumnoController::class, 'actualizar']);
Route::put('modificar/{id_ropa}', [AlumnoController::class, 'modificar']);
Route::get('/', [AlumnoController::class, 'login']);
Route::post('recibirlogin', [AlumnoController::class, 'recibirlogin']);
Route::get('pagar/{id}', [AlumnoController::class, 'pagar']);
Route::get('comprado', [AlumnoController::class, 'comprado']);
Route::get('carritoAdd/{id_ropa}/{precio_ropa}/{prenda_ropa}/{cantidad_ropa}', [AlumnoController::class, 'carritoAdd']);
Route::get('logout', [AlumnoController::class, 'logout']);



