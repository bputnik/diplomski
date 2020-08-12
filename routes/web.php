<?php


use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/login/admin', 'Auth\LoginController@showAdminLoginForm');
Route::get('/login/teacher', 'Auth\LoginController@showTeacherLoginForm');
Route::get('/login/student', 'Auth\LoginController@showStudentLoginForm');
Route::get('/register/admin', 'Auth\RegisterController@showAdminRegisterForm');
Route::get('/register/teacher', 'Auth\RegisterController@showTeacherRegisterForm');
Route::get('/register/student', 'Auth\RegisterController@showStudentRegisterForm');

Route::post('/login/admin', 'Auth\LoginController@adminLogin');
Route::post('/login/teacher', 'Auth\LoginController@teacherLogin');
Route::post('/login/student', 'Auth\LoginController@studentLogin');
Route::post('/register/admin', 'Auth\RegisterController@createAdmin');
Route::post('/register/teacher', 'Auth\RegisterController@createTeacher');
Route::post('/register/student', 'Auth\RegisterController@createStudent');

Route::view('/home', 'home')->middleware('auth');
//Route::view('/admin', 'admin');
//Route::view('/teacher', 'teacher');
//Route::view('/student', 'student');


Route::group(['middleware' => 'auth:admin'], function () {
    Route::view('/admin', 'admin.index');
    Route::view('/admin/teachers/create', 'admin.teachers.create')->name('admin.teachers.create');
    Route::view('/admin/languages/create', 'admin.languages.create')->name('admin.languages.create');
    Route::view('/admin/languages/index', 'admin.languages.index')->name('admin.languages.index');
    Route::post('/admin/languages', 'LanguageController@store')->name('admin.languages.store');

});


Route::group(['middleware' => 'auth:teacher'], function () {
    Route::view('/teacher', 'teacher');
});

Route::group(['middleware' => 'auth:student'], function () {
    Route::view('/student', 'student');
});



