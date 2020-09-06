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
    Route::get('/admin', 'AdminController@index')->name('admin.index');

    Route::get('/admin/teachers/create', 'TeacherController@create')->name('admin.teachers.create');
    Route::post('/admin/teachers/store', 'TeacherController@store')->name('admin.teachers.store');
    Route::get('/admin/teachers/show', 'TeacherController@show')->name('admin.teachers.show');
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

    Route::get('/admin/courses/types/index', 'CourseTypeController@index')->name('admin.courses.types.index');
    Route::post('/admin/courses/types', 'CourseTypeController@store')->name('admin.courses.types.store');
    Route::get('/admin/courses/types/{courseType}/edit', 'CourseTypeController@edit')->name('admin.courses.types.edit');
    Route::put('/admin/courses/types/{courseType}/update', 'CourseTypeController@update')->name('admin.courses.types.update');
    Route::delete('/admin/courses/types/{courseType}/destroy', 'CourseTypeController@destroy')->name('admin.courses.types.destroy');

    Route::get('/admin/courses/show', 'CourseController@show')->name('admin.courses.show');
    Route::get('/admin/courses/{course}/edit', 'CourseController@edit')->name('admin.courses.edit');
    Route::delete('/admin/courses/{course}/destroy', 'CourseController@destroy')->name('admin.courses.destroy');
    Route::get('/admin/courses/create', 'CourseController@create')->name('admin.courses.create');
    Route::post('/admin/courses', 'CourseController@store')->name('admin.courses.store');

    Route::get('/admin/students/show', 'StudentController@show')->name('admin.students.show');
    Route::get('/admin/students/create', 'StudentController@create')->name('admin.students.create');
    Route::post('/admin/students', 'StudentController@store')->name('admin.students.store');
    Route::get('/admin/students/{student}/edit', 'StudentController@edit')->name('admin.students.edit');
    Route::put('/admin/students/{student}/update', 'StudentController@update')->name('admin.students.update');
    Route::delete('/admin/students/{student}/destroy', 'StudentController@destroy')->name('admin.students.destroy');

    Route::get('/admin/trustees/show', 'TrusteeController@show')->name('admin.trustees.show');
    Route::get('/admin/trustees/create', 'TrusteeController@create')->name('admin.trustees.create');
    Route::get('/admin/trustees/{trustee}/edit', 'TrusteeController@edit')->name('admin.trustees.edit');
    Route::post('/admin/trustees', 'TrusteeController@store')->name('admin.trustees.store');
    Route::delete('/admin/trustees/{trustee}/destroy', 'TrusteeController@destroy')->name('admin.trustees.destroy');

    Route::get('/admin/groups/show', 'GroupController@show')->name('admin.groups.show');
    Route::get('/admin/groups/create', 'GroupController@create')->name('admin.groups.create');
    Route::get('/admin/groups/{group}/edit', 'GroupController@edit')->name('admin.groups.edit');
    Route::post('/admin/groups', 'GroupController@store')->name('admin.groups.store');
    Route::delete('/admin/groups/{group}/destroy', 'GroupController@destroy')->name('admin.groups.destroy');


    Route::get('/admin/teaching-types/index', 'TeachingTypeController@index')->name('admin.teaching-types.index');
//    Route::get('/admin/teaching-types/create', 'TeachingTypeController@create')->name('admin.teaching-types.create');
    Route::get('/admin/teaching-types/{teachingType}/edit', 'TeachingTypeController@edit')->name('admin.teaching-types.edit');
    Route::post('/admin/teaching-types', 'TeachingTypeController@store')->name('admin.teaching-types.store');
    Route::delete('/admin/teaching-types/{teachingType}/destroy', 'TeachingTypeController@destroy')->name('admin.teaching-types.destroy');
    Route::put('/admin/teaching-types/{teachingType}/update', 'TeachingTypeController@update')->name('admin.teaching-types.update');

    Route::get('/admin/payments/show', 'PaymentController@show')->name('admin.payments.show');
    Route::get('/admin/payments/create', 'PaymentController@create')->name('admin.payments.create');
    Route::post('/admin/payments/choose-student', 'PaymentController@chooseStudent')->name('admin.payments.choose-student');
    Route::post('/admin/payments/ajax-get-groups', 'PaymentController@ajaxGetGroups')->name('admin.payments.ajax-get-groups');
    Route::post('/admin.payments/ajax-get-payments', 'PaymentController@ajaxGetPayments');

    Route::get('/admin/{admin}/profile', 'AdminController@show')->name('admin.admin-profile');
    Route::put('/admin/{admin}/profile/update', 'AdminController@update')->name('admin.admin-profile-update');


});


Route::group(['middleware' => 'auth:teacher'], function () {
    Route::view('/teacher', 'teacher');
});


Route::group(['middleware' => 'auth:student'], function () {
    Route::view('/student', 'student');
});



