<?php

use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\GroupeController;
use App\Http\Controllers\DiplomeController;
use App\Http\Controllers\EnseignantController;
use App\Http\Controllers\CourController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LoginuserensController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\RegisteruserensController;
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
Route::middleware('api')->group(function () {
    Route::resource('etudiants', EtudiantController::class);
});
Route::post('/login', [LoginController::class, 'login']);
Route::post('/loginuserens', [LoginuserensController::class, 'loginuserens']);
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/registeruserens', [RegisteruserensController::class, 'registeruserens']);
Route::middleware('auth:sanctum')->post('/logout', [LoginController::class,
'logout']);
Route::middleware('auth:sanctum')->post('/deconnexion', [LoginuserensController::class,
'deconnexion']);

//Route::middleware('api')->group(function () {
 //   Route::resource('enseignants', EnseignantController::class);
//});

//Route :: get('enseignants','EnseignantController@getEnseignantController');
// get enseignants
Route::get('enseignants','EnseignantController@getEnseignant');

//Route::get('enseignants/{id}','EnseignantController@showEnseignantById');
//ajout
Route::post('storeenseignant','EnseignantController@storeEnseignant');

//updateenseignant
Route::put('updateenseignant/{id}','EnseignantController@UpdateEnseignant');            
//delet
Route::delete('destroyeenseignant/{id}','EnseignantController@DestroyEnseignant');
Route::middleware('api')->group(function () {
    Route::resource('groupes', GroupeController::class);
});
Route::middleware('api')->group(function () {
    Route::resource('cours', CourController::class);
});

Route::middleware('api')->group(function () {
    Route::resource('diplomes', DiplomeController::class);
});
