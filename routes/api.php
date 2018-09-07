<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('companies', 'CompanyController');
Route::apiResource('packages', 'PackageController');
Route::apiResource('packageusages', 'PackageUsageController');
Route::apiResource('events', 'EventController');
Route::apiResource('cvfolders', 'CvFolderController');
Route::get('jobposts/{jobPost}/activate', 'JobPostController@activate');
Route::apiResource('jobposts', 'JobPostController');
Route::get('jobposts/indexpublic/{company}','JobPostController@indexPublic');
Route::get('jobposts/indexuser/{company}','JobPostController@indexUser');
Route::get('jobposts/{jobPost}/approval', 'JobPostController@approval');
Route::apiResource('candidates', 'CandidateController');
Route::apiResource('applications ', 'ApplicationController');
Route::apiResource('users ', 'UserController');
Route::apiResource('questions ', 'QuestionController');