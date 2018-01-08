<?php

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

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/redirect', 'SocialAuthController@redirect');
Route::get('/callback', 'SocialAuthController@callback');

Route::resource('users', 'UserController');

Route::resource('roles', 'RoleController');

Route::resource('permissions', 'PermissionController');

Route::resource('facultes', 'FacultesController');

Route::resource('departements', 'DepartementsController');

Route::resource('domains', 'DomainsController');

Route::resource('filiers', 'FiliersController');

Route::resource('spesialites', 'SpesialiteController');

Route::resource('annee_acc', 'AccadimicYearController');

Route::resource('semesters', 'SemesterController');

Route::resource('grades', 'GradeController');

Route::resource('enseignants', 'EnseignantController');

Route::resource('university_years', 'UniversityYearController');

Route::resource('unit_types', 'UnitTypeController');

Route::resource('units', 'UnitController');

Route::resource('modules', 'ModuleController');

Route::resource('canvas', 'CanvaController');

Route::resource('promos', 'PromoController');

Route::resource('sections', 'SectionController');

Route::resource('groups', 'GroupController');

Route::post('promos/addsection/{id}', ['as' => 'promos.addsection', 'uses' => 'PromoController@addsection']);

Route::resource('students', 'StudentController');

Route::group(['prefix' => 'messages'], function () {
    Route::get('/', ['as' => 'messages', 'uses' => 'MessagesController@index']);
    Route::get('create', ['as' => 'messages.create', 'uses' => 'MessagesController@create']);
    Route::post('/', ['as' => 'messages.store', 'uses' => 'MessagesController@store']);
    Route::get('{id}', ['as' => 'messages.show', 'uses' => 'MessagesController@show']);
    Route::put('{id}', ['as' => 'messages.update', 'uses' => 'MessagesController@update']);
    Route::post('/newmessages', ['as' => 'messages.newmessages', 'uses' => 'MessagesController@getlatestmessages']);
    Route::post('/allmessages', ['as' => 'messages.allmessages', 'uses' => 'MessagesController@getallmessages']);
});

Route::group(['prefix' => 'domains'], function () {
    Route::post('/getfiliers', ['as' => 'getfiliers', 'uses' => 'DomainsController@getFiliers']);
});

Route::group(['prefix' => 'filiers'], function () {
    Route::post('/getspesialite', ['as' => 'getspesialite', 'uses' => 'FiliersController@getSpesialite']);
});


