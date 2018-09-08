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
Route::get('events/index-public/{company}', 'EventController@indexPublic');
Route::apiResource('events', 'EventController');
Route::apiResource('cvfolders', 'CvFolderController');
Route::get('job-posts/{jobPost}/activate', 'JobPostController@activate');
Route::get('job-posts/index-public/{company}','JobPostController@indexPublic');
Route::get('job-posts/index-user/{company}','JobPostController@indexUser');
Route::get('job-posts/{jobPost}/approval', 'JobPostController@approval');
Route::apiResource('job-posts', 'JobPostController');
Route::apiResource('candidates', 'CandidateController');
Route::apiResource('applications ', 'ApplicationController');
Route::apiResource('users ', 'UserController');
Route::apiResource('questions ', 'QuestionController');