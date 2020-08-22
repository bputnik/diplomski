<?php


//use Illuminate\Support\Facades\Auth;
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
    Route::get('/admin/teachers/create', 'TeacherController@create')->name('admin.teachers.create');
    Route::post('/admin/teachers/store', 'TeacherController@store')->name('admin.teachers.store');
    Route::get('admin/teachers/show', 'TeacherController@show')->name('admin.teachers.show');
    Route::get('/admin/teachers/{teacher}/edit', 'TeacherController@edit')->name('admin.teachers.edit');
    Route::delete('/admin/teachers/{teacher}/destroy', 'TeacherController@destroy')->name('admin.teachers.destroy');
    Route::put('/admin/teachers/{teacher}/attach', 'TeacherController@attach_language')->name('admin.teachers.attach_language');
    Route::put('/admin/teachers/{teacher}/detach', 'TeacherController@detach_language')->name('admin.teachers.detach_language');
    Route::put('/admin/teachers/{teacher}/update', 'TeacherController@update')->name('admin.teachers.update');

    Route::view('/admin/languages/create', 'admin.languages.create')->name('admin.languages.create');
    Route::get('/admin/languages/index', 'LanguageController@index')->name('admin.languages.index');
    Route::post('/admin/languages', 'LanguageController@store')->name('admin.languages.store');
    Route::get('/admin/languages/{language}/edit', 'LanguageController@edit')->name('admin.languages.edit');
    Route::put('/admin/languages/{language}/update', 'LanguageController@update')->name('admin.languages.update');
    Route::delete('/admin/languages/{language}/destroy', 'LanguageController@destroy')->name('admin.languages.destroy');

    Route::get('/admin/levels/index', 'LevelController@index')->name('admin.levels.index');
    Route::get('/admin/levels/create', 'LevelController@create')->name('admin.levels.create');
    Route::post('/admin/levels', 'LevelController@store')->name('admin.levels.store');
    Route::get('/admin/levels/{level}/edit', 'LevelController@edit')->name('admin.levels.edit');
    Route::put('/admin/levels/{level}/update', 'LevelController@update')->name('admin.levels.update');
    Route::delete('/admin/levels/{level}/destroy', 'LevelController@destroy')->name('admin.levels.destroy');

    Route::get('/admin/{admin}/profile', 'AdminController@show')->name('admin.admin-profile');
    Route::put('/admin/{admin}/profile/update', 'AdminController@update')->name('admin.admin-profile-update');


});


Route::group(['middleware' => 'auth:teacher'], function () {
    Route::view('/teacher', 'teacher');
});


Route::group(['middleware' => 'auth:student'], function () {
    Route::view('/student', 'student');
});



