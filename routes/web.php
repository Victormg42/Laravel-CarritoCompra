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
Route::get('crear', [AlumnoController::class, 'crear']);
Route::post('recibir', [AlumnoController::class, 'recibir']);
Route::get('actualizar/{id_ropa}', [AlumnoController::class, 'actualizar']);
Route::put('modificar/{id_ropa}', [AlumnoController::class, 'modificar']);
Route::get('/', [AlumnoController::class, 'login']);
Route::post('recibirlogin', [AlumnoController::class, 'recibirlogin']);
Route::get('pagar/{id_ropa}/{precio_ropa}', [AlumnoController::class, 'pagar']);
Route::post('comprado/{id_ropa}', [AlumnoController::class, 'comprado']);



