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

        Route::get('/etudiantall','EtudiantController@index');
        Route::get('/etudiant/{id}','EtudiantController@show');
        Route::get('/currentetudiant','EtudiantController@currentetudiant');

        Route::get('/binome','EtudiantController@binome');
        Route::post('/addbinome','EtudiantController@addbinome');
        Route::post('/deletebinome','EtudiantController@deletebinome');
        Route::post('/acceptbinome','EtudiantController@acceptbinome');
        Route::post('/refusebinome','EtudiantController@refusebinome');

        Route::post('/addencadrant','SujetController@addencadrant');
        Route::delete('/deleteencadrant','SujetController@deleteencadrant');

        Route::post('/demandesave','DemandeDeStageController@create');
        Route::get('/mesdemandes','DemandeDeStageController@mesdemandes');
        Route::get('/demandeall','DemandeDeStageController@index');
        Route::get('/demande/{id}','DemandeDeStageController@show');
        Route::put('/demande/update/{id}','DemandeDeStageController@update');
        Route::delete('/demande/delete/{id}','DemandeDeStageController@destroy');
        //ADMIN
        Route::post('/demande/affecter/{id}','DemandeDeStageController@affecter');

        Route::get('/getstageetudiant','EtudiantController@stage');
        Route::get('/getetudiantstage/{id}','StageController@etudiant');

        Route::get('/enseignantall','EnseignantController@index');
        Route::get('/enseignant/{id}','EnseignantController@show');
        Route::post('/enseignantsave','EnseignantController@create');
        Route::put('/enseignant/update/{id}','EnseignantController@update');
        Route::delete('/enseignant/delete/{id}','EnseignantController@destroy');

        Route::post('/sujetsave','SujetController@create');





    });

});
