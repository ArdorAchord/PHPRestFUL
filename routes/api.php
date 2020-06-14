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

Route::post('students', 'StudentController@store');

Route::delete('students/{student_id}', 'StudentController@destroy');

Route::post('students/courses', 'StudentController@courseStore');

Route::delete('students/courses/{student_id}/{course_id}', 'StudentController@courseDestroy');

Route::post('teachers', 'TeacherController@store');

Route::delete('teachers/{teacher_id}', 'TeacherController@destroy');

Route::post('courses', 'CourseController@store');

Route::get('courses', 'CourseController@index');

Route::get('courses/{course_id}', 'CourseController@show');

Route::get('courses/students/{course_id}', 'CourseController@studentShow');

Route::put('courses/{course_id}', 'CourseController@update');

Route::delete('courses/{course_id}', 'CourseController@destroy');





