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

Route::post('apply/{jobPost} ', 'ApplicationController@store');
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'company', 'as' => 'company.'], function () {
    Route::apiResource('', 'CompanyController', ['parameters' => ['' => 'company']]);
    Route::get('users/{company}', 'CompanyController@companyUsers');
    Route::get('user/approval/{user}', 'CompanyController@userApproval');

});

Route::group(['prefix' => 'job-post', 'as' => 'company.'], function () {
    Route::get('index-public/{company}', 'JobPostController@indexPublic');
    Route::get('index-user/{company}', 'JobPostController@indexUser');
    Route::get('activate/{jobPost}', 'JobPostController@activate');
    Route::get('approval/{jobPost}', 'JobPostController@approval');
    Route::get('/last-five', 'JobPostController@lastFive');
    Route::get('/index-waiting', 'JobPostController@indexWaiting');
    Route::get('/index-live', 'JobPostController@indexLive');
    Route::get('/index-expired', 'JobPostController@indexExpired');
    Route::get('/applications/{jobPost}', 'JobPostController@jobPostApplications');
    Route::apiResource('', 'JobPostController', ['parameters' => ['' => 'jobPost']]);

});

Route::group(['prefix' => 'event', 'as' => 'event.'], function () {
    Route::apiResource('', 'EventController', ['parameters' => ['' => 'event']]);
    Route::get('index-public/{company}', 'EventController@indexPublic');
});

Route::group(['prefix' => 'cv-folder', 'as' => 'cvFolder.'], function () {
    Route::apiResource('', 'CvFolderController', ['parameters' => ['' => 'cvFolder']]);
    Route::get('job-post/{jobPost}', 'CvFolderController@jobPostCvFolders');
    Route::post('store/{jobPost}', 'CvFolderController@store');
    Route::get('applications/{cvFolder} ', 'CvFolderController@cvFolderApplications');
});

Route::group(['prefix' => 'candidate', 'as' => 'candidate.'], function () {
    Route::apiResource('', 'CandidateController', ['parameters' => ['' => 'candidate']]);
    Route::post('exists/{jobPost}', 'CandidateController@candidateExist');
});

Route::group(['prefix' => 'question', 'as' => 'question.'], function () {
    Route::apiResource('', 'QuestionController', ['parameters' => ['' => 'question']]);
    Route::get('job-post/{jobPost} ', 'QuestionController@jobPostQuestions');
    Route::post('answer/{jobPost} ', 'QuestionController@answerCheck');
    Route::post('create/{jobPost} ', 'QuestionController@store');
    Route::get('{question} ', 'QuestionController@show');
});

Route::apiResource('packages', 'PackageController');

Route::apiResource('package-usages', 'PackageUsageController');

Route::group(['prefix' => 'application', 'as' => 'applications.'], function () {
Route::apiResource('', 'ApplicationController', ['parameters' => ['' => 'application']]);
    Route::post('applied-before/{jobPost} ', 'ApplicationController@appliedBefore');
    Route::get('change-cv-folder/{application}/{cvFolder} ', 'ApplicationController@changeCvFolder');
});


Route::apiResource('users ', 'UserController');

Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
    Route::apiResource('', 'UserController', ['parameters' => ['' => 'question']]);
    Route::get('show','UserController@show');
    Route::post('logout','UserController@logoutApi');
    Route::post('/join-company/{company}','UserController@joinCompany');

});



