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
    return view('auth.login');
});


Auth::routes();
Route::group(['middleware' => ['auth']], function() {
    Route::get('/home', 'HomeController@index')->name('home');
    
    //user permissions
    Route::get('/roles', 'UserPermissionController@index')->name('role.index');
    Route::post('/create-role', 'UserPermissionController@roleCreate')->name('role.add');
    Route::get('/role/create', 'UserPermissionController@Create')->name('role.create');
    Route::get('/role/edit/{id}', 'UserPermissionController@REdit')->name('role.edit');
    Route::post('/role/update/{id}', 'UserPermissionController@RoleUpdate')->name('role.update');
    Route::post('/remove/role', 'UserPermissionController@RoleRemove');

    Route::get('/create/user/roles', 'UserPermissionController@createUserRole')->name('user.role.create');
    Route::get('/edit/user/roles/{id}', 'UserPermissionController@editUserRole')->name('user.role.edit');
    Route::post('/update/user/roles/{id}', 'UserPermissionController@UpdateUserRole')->name('user.role.update');


    Route::get('/permission', 'UserPermissionController@permissionIndex')->name('permission.index');
    Route::post('/create-permission', 'UserPermissionController@permissionCreate')->name('permission.add');
    Route::get('/permission/edit{id}', 'UserPermissionController@permissionEdit')->name('permission.edit');
    Route::post('/permission/remove', 'UserPermissionController@permissionRemove');
    Route::post('/permission/update', 'UserPermissionController@permissionUpdate')->name('permission.update');
    Route::post('/remove/user/role', 'UserPermissionController@userRoleRemove');

    Route::get('/give-user-permissions', 'UserPermissionController@permissionForUser')->name('permission.user');
    Route::post('/create-user-role', 'UserPermissionController@userRoleCreate')->name('user.role.add');

    //prescriptions
    Route::get('/prescriptions', 'PrescriptionController@index')->name('prescriptions.index');
    Route::get('/add-prescriptions', 'PrescriptionController@create')->name('prescriptions.add');
    Route::post('/upload-prescriptions', 'PrescriptionController@uploadImages')->name('prescriptions.uploadImages');
    Route::get('/view-prescriptions/{id}', 'PrescriptionController@uploadPrescriptionView')->name('prescriptions.view');

     //prescriptions
     Route::get('/my-prescriptions', 'PrescriptionController@cusindex')->name('prescriptions.cus.index');
     Route::get('/view-my-prescriptions/{id}', 'PrescriptionController@myPrescriptionView')->name('myprescriptions.view');
    

    //drug management
    Route::get('/drug', 'DrugController@index')->name('drug.index');
    Route::post('/drug-save', 'DrugController@save')->name('drug.save');
    Route::post('/drug-status-change', 'DrugController@changeStatus');

    //quotations
    Route::post('/quotations-process', 'QuotationController@process');
    Route::post('/quotations-send', 'QuotationController@send')->name('quotations.send');
    Route::post('/quotations-reject', 'QuotationController@reject');

    Route::post('/notification', 'QuotationController@notification');
   
});

Route::get('/check-phpinfo', function(){
	phpinfo();
});
///http://52.66.188.137/