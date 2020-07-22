<?php

use App\Enseignant;
use App\Http\Controllers\DepotController;
use App\Http\Controllers\EnseignantController;
use App\Http\Controllers\SujetController;
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
    Route::get('/pdf','PDFController@print');
    Route::get('/demande/print/{id}','PDFController@printdemande');
    Route::get('/lettre/print/{id}','PDFController@printlettre');
    Route::get('/journal/print/{id}','PDFController@printjournal');
    Route::get('/convention/print/{id}','PDFController@printconvention');


    Route::get('/download/rapport/{etudiant}','DepotController@DownloadRapport');
    //Loggedin Users
    Route::group(['middleware' => 'auth:api'], function () {
        //Infos User
        Route::post('/deposer/rapport','DepotController@UploadRapport');

        Route::put('/changemdp','UserController@changemdp');
        Route::put('/updateinfos','EtudiantController@update');
        Route::put('/updateadmin','AdminController@update');

        Route::post('password/email', 'ForgotPasswordController@forgot');
        Route::post('password/reset', 'ForgotPasswordController@reset');


        Route::post('/adminsave','AdminController@create');
        Route::get('/currentadmin','AdminController@currentadmin');

        Route::get('/reclamation/{id}','ReclamationController@show');
        Route::get('/reclamationsall','ReclamationController@index');
        Route::post('/reclamationsave','ReclamationController@create');

        Route::get('/soutenancesall','SoutenanceController@index');
        Route::get('/soutenance/{id}','SoutenanceController@show');
        Route::post('/soutenance/modifier/{id}','SoutenanceController@update');




        //Demande de Stage CRUD
        Route::get('/etudiantall','EtudiantController@index');
        Route::get('/etudiant/{id}','EtudiantController@show');
        Route::post('/etudiantsave','EtudiantController@create');
        Route::post('/etudiant/update/{id}','EtudiantController@updatebyid');
        Route::get('/currentetudiant','EtudiantController@currentetudiant');
        Route::get('/getbinomes','EtudiantController@getbinomes');

        Route::get('/binome','EtudiantController@binome');
        Route::get('/demandesbinome','EtudiantController@demandesbinome');
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
        Route::put('demande/affecter/{id}','DemandeDeStageController@affecter');
        Route::put('stage/desaffecter/{id}','StageController@desaffecter');


        Route::get('/getstageetudiant','EtudiantController@stage');
        Route::get('/getetudiantstage/{id}','StageController@etudiant');
        Route::get('/stage/{id}','StageController@show');
        Route::post('/stage/complete','StageController@update');
        Route::post('/stage/modifier/{id}','StageController@updatebyid');

        Route::get('/stagesall','StageController@index');

        Route::get('/enseignantall','EnseignantController@index');
        Route::get('/enseignant/{id}','EnseignantController@show');
        Route::get('/enseignant/{id}/sujets','EnseignantController@sujets');
        Route::post('/enseignantsave','EnseignantController@create');
        Route::put('/enseignant/update/{id}','EnseignantController@update');
        Route::delete('/enseignant/delete/{id}','EnseignantController@destroy');

        Route::post('/accepterencadrement/{id}','SujetController@acceptencadrement');
        Route::post('/refuserencadrement/{id}','SujetController@refuserencadrement');

        Route::post('/sujetsave','SujetController@create');
        Route::get('/sujetsall','SujetController@index');
        Route::get('/sujet/{id}','SujetController@show');
        Route::get('/messujetsenc','EnseignantController@sujets');
        Route::get('/mesdemandesenc','EnseignantController@demandes');
        Route::post('/sujet/modifier/{id}','SujetController@updatebyid');

        Route::get('/monsujet','EtudiantController@sujet');

        Route::post('/seancesave', 'SujetController@planifier');
        Route::get('/seanceget', 'SujetController@getseances');

        // Route::post('/upload/rapport','DepotController@UploadRapport');
        Route::post('/upload/rapport','DepotController@upload');






    });


});

