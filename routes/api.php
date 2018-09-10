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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

//Route::group(['prefix'=>'company', 'as' => 'company.'], function () {
//    Route::apiResource('', 'CompanyController', ['parameters' => ['' => 'company']]);
//});

Route::apiResource('companies', 'CompanyController');
Route::apiResource('packages', 'PackageController');
Route::apiResource('packageusages', 'PackageUsageController');
Route::get('events/index-public/{company}', 'EventController@indexPublic');
Route::apiResource('events', 'EventController');
Route::get('job-post/cv-folders/{jobPost}', 'CvFolderController@jobPostCvFolders');
Route::apiResource('cvfolders', 'CvFolderController');
Route::get('job-posts/{jobPost}/activate', 'JobPostController@activate');
Route::get('job-posts/index-public/{company}','JobPostController@indexPublic');
Route::get('job-posts/index-user/{company}','JobPostController@indexUser');
Route::get('job-posts/{jobPost}/approval', 'JobPostController@approval');
Route::apiResource('job-posts', 'JobPostController');
Route::post('candidate/exists/{job-post?}', 'CandidateController@candidateExist');
Route::apiResource('candidates', 'CandidateController');
Route::post('apply/{candidate}/{job-post} ', 'ApplicationController@store');
Route::post('applications/new-candidate/{job-post} ', 'ApplicationController@newCandidate');
Route::apiResource('users ', 'UserController');
Route::get('job-post/questions/{jobPost} ', 'QuestionController@jobPostQuestions');
Route::post('question/answer/{jobPost} ', 'QuestionController@answerCheck');
Route::apiResource('questions ', 'QuestionController');