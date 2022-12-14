<?php

use App\Http\Controllers\API\RolesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use \App\Http\Controllers\API\FashionCompanyController;
use \App\Http\Controllers\API\ContentController;
use \App\Http\Controllers\API\InstructorController;
use \App\Http\Controllers\API\CMSController;
use \App\Http\Controllers\API\ColStructController;
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



Route::group(['prefix'  =>  'v1'],function () {
    //No Auth
    Route::post('login',[UserController::class,'login']);
    Route::post('admin/login',[UserController::class,'loginAdmin']);
    Route::group(['prefix'  =>  'user', 'namespace'=>'Api\V1\Auth'],function () {
        Route::post('create',[UserController::class,'store']);
    });
    Route::group(['prefix'  =>  'content', 'namespace'=>'Api\V1\Auth'],function () {
        Route::get('/',[ContentController::class,'index']);
        Route::post('/update',[ContentController::class,'updateContext']);
        Route::post('/context',[ContentController::class,'getContextById']);
    });
//    Route::get('/list',[InstructorController::class,'getInstructionList']);


    //End No Auth

    //Auth
    Route::group(['middleware' => 'auth:sanctum'], function () {
        //Get User
        Route::get('/user', function (Request $request) {
            return $request->user();
        });

        Route::post('/users',[UserController::class,'index']);
        //Import CSV
        Route::post('imported', [FashionCompanyController::class,'imported'])->name('imported');
        //////////////------------------------------------------------------------------------//////////////
        Route::group(['prefix'  =>  'user'],function(){
            Route::resource('roles', RolesController::class)->except(['update']);
            Route::post('role/{role}', [RolesController::class,'update']);
            Route::get('role/{id}', [RolesController::class,'listOfPermissionWithRoleId']);
        });
        Route::group(['prefix'  =>  'company'],function(){
            Route::get('detail',[FashionCompanyController::class,'index']);
            Route::post('/list',[FashionCompanyController::class,'ListOfCompanies']);
            Route::post('detail',[FashionCompanyController::class,'update']);
            Route::post('create',[FashionCompanyController::class,'store']);
            Route::post('form/store',[FashionCompanyController::class,'formDataSubmit']);
        });
        Route::group(['prefix'=>'instruction'],function(){
            Route::post('/store',[InstructorController::class,'store']);
            Route::get('/get',[InstructorController::class,'getInstruction']);
            Route::post('/list',[InstructorController::class,'getInstructionList']);
            Route::post('/status',[InstructorController::class,'statusUpdate']);
            Route::post('/logs/list',[InstructorController::class,'getInstructionLogList']);
        });
        Route::group(['prefix'=>'cms'],function(){
            Route::get('/',[CMSController::class,'index']);
            Route::post('/upload',[CMSController::class,'store']);
        });
        Route::group(['prefix'=>'col'],function(){
            Route::post('/',[ColStructController::class,'createCol']);
            Route::get('/list',[ColStructController::class,'index']);
            Route::post('/toggle',[ColStructController::class,'updateToggle']);
        });
    });


});
