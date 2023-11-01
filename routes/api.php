<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\PublicacionController;
use App\Http\Controllers\TipoPublicacionController;
use App\Http\Controllers\TipoUsuarioController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//CATEGORIAS
Route::get('categoria/index', [CategoriaController::class, 'index'] );
Route::post('categoria/store', [CategoriaController::class, 'store']);
Route::get('categoria/find/{id}', [CategoriaController::class, 'find']);
Route::put('categoria/update/{id}', [CategoriaController::class, 'update']);
Route::delete('categoria/delete/{id}', [CategoriaController::class, 'delete']);


//TIPO DE USUARIOS
Route::get('tipoUsuario/index', [TipoUsuarioController::class, 'index'] );
Route::post('tipoUsuario/store', [TipoUsuarioController::class, 'store']);
Route::get('tipoUsuario/find/{id}', [TipoUsuarioController::class, 'find']);
Route::put('tipoUsuario/update/{id}', [TipoUsuarioController::class, 'update']);
Route::delete('tipoUsuario/delete/{id}', [TipoUsuarioController::class, 'delete']);

//TIPO PUBLICACIÓN
Route::get('tipoPublicacion/index', [TipoPublicacionController::class, 'index'] );
Route::post('tipoPublicacion/store', [TipoPublicacionController::class, 'store']);
Route::get('tipoPublicacion/find/{id}', [TipoPublicacionController::class, 'find']);
Route::put('tipoPublicacion/update/{id}', [TipoPublicacionController::class, 'update']);
Route::delete('tipoPublicacion/delete/{id}', [TipoPublicacionController::class, 'delete']);

//USUARIOS
Route::get('usuario/index', [UsuarioController::class, 'index'] );
Route::post('usuario/store', [UsuarioController::class, 'store']);
Route::get('usuario/find/{id}', [UsuarioController::class, 'find']);
Route::put('usuario/update/{id}', [UsuarioController::class, 'update']);
Route::delete('usuario/delete/{id}', [UsuarioController::class, 'delete']);

//PUBLICACION
Route::get('publicacion/index', [PublicacionController::class, 'index'] );
Route::post('publicacion/store', [PublicacionController::class, 'store']);
Route::get('publicacion/find/{id}', [PublicacionController::class, 'find']);
Route::put('publicacion/update/{id}', [PublicacionController::class, 'update']);
Route::delete('publicacion/delete/{id}', [PublicacionController::class, 'delete']);


//COMENTARIOS
Route::get('comentario/index', [ComentarioController::class, 'index'] );
Route::post('comentario/store', [ComentarioController::class, 'store']);
Route::get('comentario/find/{id}', [ComentarioController::class, 'find']);
Route::put('comentario/update/{id}', [ComentarioController::class, 'update']);
Route::delete('comentario/delete/{id}', [ComentarioController::class, 'delete']);
