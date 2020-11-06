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
    //return view('welcome');
    return redirect()->route('login');
});

Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false,
    'confirm' => false,
]);

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('/users', 'UserController', ['except' => ['show']]);
    Route::post('users/search', 'UserController@search')->name('users.search');
    Route::resource('/roles', 'RoleController', ['except' => ['show']]);
    Route::post('roles/search', 'RoleController@search')->name('roles.search');
    Route::resource('/states', 'StateController', ['except' => ['show']]);
    Route::post('states/search', 'StateController@search')->name('states.search');
    Route::resource('/cities', 'CityController', ['except' => ['show']]);
    Route::post('cities/search', 'CityController@search')->name('cities.search');
    Route::resource('/notices', 'NoticeController', ['except' => ['show']]);
    Route::post('notices/search', 'NoticeController@search')->name('notices.search');
});

Route::prefix('default')->name('default.')->group(function () {
    Route::resource('/customers', 'CustomerController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);
    Route::post('customers/search', 'CustomerController@search')->name('customers.search');
    Route::resource('/cables', 'CableController', ['except' => ['show']]);
    Route::post('cables/search', 'CableController@search')->name('cables.search');
    Route::resource('/boxes', 'ServiceBoxController', ['except' => ['show']]);
    Route::post('boxes/search', 'ServiceBoxController@search')->name('boxes.search');
    Route::get('boxes/customers', 'ServiceBoxController@getBoxCustomers')->name('boxes.customers');
    // PROCESS STAGE 1
    Route::get('/process/stage/1', 'ProcessStageOneController@index_stage_one')->name('process_stage_one.index');
    Route::get('/process/stage/1/create', 'ProcessStageOneController@create_stage_one')->name('process_stage_one.create');
    Route::post('/process/stage/1', 'ProcessStageOneController@store_stage_one')->name('process_stage_one.store');
    Route::get('/process/stage/1/{process}/edit', 'ProcessStageOneController@edit_stage_one')->name('process_stage_one.edit');
    Route::put('/process/stage/1/{process}', 'ProcessStageOneController@update_stage_one')->name('process_stage_one.update');
    Route::post('/process/stage/1/search', 'ProcessStageOneController@search')->name('process_stage_one.search');
    // PROCESS STAGE 2
    Route::get('/process/stage/2', 'ProcessStageTwoController@index_stage_two')->name('process_stage_two.index');
    Route::get('/process/stage/2/{process}/edit', 'ProcessStageTwoController@edit_stage_two')->name('process_stage_two.edit');
    Route::put('/process/stage/2/{process}', 'ProcessStageTwoController@update_stage_two')->name('process_stage_two.update');
    Route::post('/process/stage/2/search', 'ProcessStageTwoController@search')->name('process_stage_two.search');
    // PROCESS STAGE 3
    Route::get('/process/stage/3', 'ProcessStageThreeController@index_stage_three')->name('process_stage_three.index');
    Route::get('/process/stage/3/{process}/edit', 'ProcessStageThreeController@edit_stage_three')->name('process_stage_three.edit');
    Route::put('/process/stage/3/{process}', 'ProcessStageThreeController@update_stage_three')->name('process_stage_three.update');
    Route::post('/process/stage/3/search', 'ProcessStageThreeController@search')->name('process_stage_three.search');
    // PROCESS STAGE 4
    Route::get('/process/stage/4', 'ProcessStageFourController@index_stage_four')->name('process_stage_four.index');
    Route::get('/process/stage/4/{process}/edit', 'ProcessStageFourController@edit_stage_four')->name('process_stage_four.edit');
    Route::put('/process/stage/4/{process}', 'ProcessStageFourController@update_stage_four')->name('process_stage_four.update');
    Route::post('/process/stage/4/search', 'ProcessStageFourController@search')->name('process_stage_four.search');
    // PROCESS STAGE 5
    Route::get('/process/stage/5', 'ProcessStageFiveController@index_stage_five')->name('process_stage_five.index');
    Route::get('/process/stage/5/{process}/edit', 'ProcessStageFiveController@edit_stage_five')->name('process_stage_five.edit');
    Route::put('/process/stage/5/{process}', 'ProcessStageFiveController@update_stage_five')->name('process_stage_five.update');
    Route::post('/process/stage/5/search', 'ProcessStageFiveController@search')->name('process_stage_five.search');
    Route::delete('/process/finish/{process}', 'ProcessStageFiveController@destroy_process')->name('process.finish');
    // NEXT AND RETURN
    Route::get('/process/next/{process}', 'ProcessController@next_stage')->name('process.next_stage');
    Route::put('/process/previous/{process}', 'ProcessController@previous_stage')->name('process.previous_stage');
    Route::get('/process/previous/log/', 'ProcessController@get_log')->name('process.log');
    // PROCESS HISTORY
    Route::get('/process/history', 'ProcessController@index_history')->name('process_history.index');
    Route::get('/process/history/{id}', 'ProcessController@history_show')->name('process_history.show');
    Route::post('/process/history/search', 'ProcessController@history_search')->name('history.search');
    Route::get('/process/list', 'ProcessController@index_list')->name('process_list.index');
    Route::get('/process/list/{id}', 'ProcessController@list_show')->name('process_list_show.show');
    Route::post('/process/list/search', 'ProcessController@list_search')->name('list.search');
});

Route::get('/profile/{id}', 'UserController@showProfile')->name('users.profile');
Route::put('/profile/{id}', 'UserController@updateProfile')->name('users.profile.update');
Route::get("/has-registered-cities", "ProcessController@checkIfThereAreRegisteredCities")->name('has_registered_cities');
Route::get("/has-registered-cities-with-linked-processes/{id}", "HasController@hasProcessesLinkedToTheCity")->name('has_registered_cities_with_linked_processes');

Route::prefix('reports')->name('reports.')->group(function () {
    Route::get('/', 'ReportsController@index')->name('index');
    Route::get('/reports/users', 'PDFController@generateUserReport')->name('user_report');
    Route::get('/reports/roles', 'PDFController@generateRoleReport')->name('role_report');
    Route::get('/reports/rules', 'PDFController@generateRuleReport')->name('rule_report');
    Route::get('/reports/cities', 'PDFController@generateCitiesReport')->name('cities_report');
    Route::get('/reports/states', 'PDFController@generateStatesReport')->name('states_report');
    Route::get('/reports/cables', 'PDFController@generateCablesReport')->name('cables_report');
    Route::get('/reports/boxes', 'PDFController@generateBoxesReport')->name('boxes_report');
    Route::get('/reports/processes', 'PDFController@generateProcessesReport')->name('processes_report');
    Route::get('/reports/customers-by-box', 'PDFController@generateCustomersByBoxReport')->name('customers_by_box_report');
    Route::get('/reports/footage-comparison', 'PDFController@generateFootageComparasionReport')->name('footage_comparasion_report');
    Route::get('/reports/occupation', 'PDFController@generateOccupationReport')->name('occupation_report');
    Route::get('/reports/customers', 'PDFController@generateCustomersReport')->name('customers_report');
});

Route::get('send-request-notification/{id}', 'ProcessStageFourController@sendTelegramMessage')->name('send_request');
Route::get('send-solved-notification/{id}', 'ProcessStageFiveController@sendSolvedTelegramMessage')->name('send_solved');
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->name('logs')->middleware('auth');