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
    Route::group(['middleware' => 'auth:api'], function () {
        //Demande de Stage CRUD
        Route::post('/demandesave','DemandeDeStageController@create');

        Route::get('/binome','EtudiantController@binome');
        Route::post('/addbinome','EtudiantController@addbinome');
        Route::post('/acceptbinome','EtudiantController@acceptbinome');
        Route::post('/deletebinome','EtudiantController@deletebinome');
        Route::post('/acceptbinome','EtudiantController@acceptbinome');
        Route::post('/refusebinome','EtudiantController@refusebinome');


        Route::get('/demandeall','DemandeDeStageController@index');
        Route::get('/demande/{id}','DemandeDeStageController@show');
        Route::put('/demande/update/{id}','DemandeDeStageController@update');
        Route::delete('/demande/delete/{id}','DemandeDeStageController@destroy');
    });

});
