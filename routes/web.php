<?php

Route::redirect('/', '/login');
Route::redirect('/home', '/admin');
// Auth::routes(['register' => false]);
Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Services
    Route::delete('services/destroy', 'ServicesController@massDestroy')->name('services.massDestroy');
    Route::resource('services', 'ServicesController');

    // Employees
    Route::delete('employees/destroy', 'EmployeesController@massDestroy')->name('employees.massDestroy');
    Route::post('employees/media', 'EmployeesController@storeMedia')->name('employees.storeMedia');
    Route::resource('employees', 'EmployeesController');

    // Leads
    Route::delete('leads/destroy', 'LeadsController@massDestroy')->name('leads.massDestroy');
    Route::resource('leads', 'LeadsController');

    // Clients
    Route::delete('clients/destroy', 'ClientsController@massDestroy')->name('clients.massDestroy');
    Route::resource('clients', 'ClientsController');

    // Appointments
    Route::delete('appointments/destroy', 'AppointmentsController@massDestroy')->name('appointments.massDestroy');
    Route::resource('appointments', 'AppointmentsController');

    // Reports
    Route::delete('reports/destroy', 'ReportsController@massDestroy')->name('reports.massDestroy');
    Route::resource('reports', 'ReportsController');

    // Settings
    Route::delete('settings/destroy', 'SettingsController@massDestroy')->name('settings.massDestroy');
    Route::resource('settings', 'SettingsController');

    Route::get('/payment_schedule/show', 'SettingsController@paymentsScheduleShow')->name('payment_schedule.show');
    Route::get('/payment_schedule/create', 'SettingsController@paymentScheduleCreate')->name('payment_schedule.create');
    Route::post('/payment_schedule/store', 'SettingsController@paymentsScheduleStore')->name('payment_schedule.store');


    //Calendar
    Route::get('system-calendar', 'SystemCalendarController@index')->name('systemCalendar');

    // Profile
    Route::prefix('/profile')->group(function () {
        Route::get('/settings', 'UserProfileController@index')->name('profile.index');
        Route::post('/settings/update', 'UserProfileController@updateProfile')->name('profile.update');
        Route::get('/staff', 'UserProfileController@index');
        Route::post('/password/change', 'Auth\ResetPasswordController@changePassword');
    });
});
