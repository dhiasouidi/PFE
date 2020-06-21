<?php

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

//Users
Route::prefix('/')->group(function(){
    Route::post('/login','api\LoginController@login');
    Route::post('/forgot','ForgotController@forgot');
    //Loggedin Users
    Route::middleware('auth:api')->post('/demandesave','DemandeDeStageController@create');
    Route::middleware('auth:api')->get('/demandeall','DemandeDeStageController@index');
    Route::middleware('auth:api')->get('/demande/{id}','DemandeDeStageController@show');
    Route::middleware('auth:api')->put('/demande/edit/{id}','DemandeDeStageController@edit');
    Route::middleware('auth:api')->delete('/demande/delete/{id}','DemandeDeStageController@destroy');

});
