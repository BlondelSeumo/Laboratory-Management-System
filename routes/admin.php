<?php

//login admin
Route::group(['namespace'=>'Auth','prefix'=>'admin/auth','middleware'=>'AdminGuest','as'=>'admin.auth.'],function(){
    Route::get('/login','AdminController@login')->name('login');
    Route::post('/login','AdminController@login_submit')->name('login_submit');
});
//logout admin
Route::post('admin/logout','Auth\AdminController@logout')->name('admin.logout')->middleware('Admin');

//reset admin users password
Route::group(['namespace'=>'Auth','prefix'=>'admin/reset','as'=>'admin.reset.'],function(){
    Route::get('/mail','AdminController@mail')->name('mail');
    Route::post('/mail_submit','AdminController@mail_submit')->name('mail_submit');
    Route::get('/reset_password_form/{token}','AdminController@reset_password_form')->name('reset_password_form');
    Route::post('/reset_password_submit','AdminController@reset_password_submit')->name('reset_password_submit');
});

//admin controls 
Route::group(['prefix'=>'admin','as'=>'admin.','namespace'=>'Admin','middleware'=>'Admin'],function(){
    //dashboard
    Route::get('/','IndexController@index')->name('index'); 

    //dashboard
    Route::resource('tests','TestsController'); 

    //profile
    Route::group(['prefix'=>'profile','as'=>'profile.'],function(){
        Route::get('edit','ProfileController@edit')->name('edit');
        Route::post('update','ProfileController@update')->name('update');
    });

    //tests and its components
    Route::resource('tests','TestsController');
    Route::get('get_tests','TestsController@ajax')->name('get_tests');//datatable
    
    //antibiotics
    Route::resource('antibiotics','AntibioticsController');
    Route::get('get_antibiotics','AntibioticsController@ajax')->name('get_antibiotics');
    
    //patients
    Route::resource('patients','PatientsController');
    Route::get('get_patients','PatientsController@ajax')->name('get_patients'); 
    Route::get('patients_export','PatientsController@export')->name('patients.export'); 
    Route::get('patients_download_template','PatientsController@download_template')->name('patients.download_template'); 
    Route::post('patients_import','PatientsController@import')->name('patients.import'); 
   
    //cultures
    Route::resource('cultures','CulturesController');
    Route::get('get_cultures','CulturesController@ajax')->name('get_cultures');//datatable

    //culture options
    Route::resource('culture_options','CultureOptionsController');
    Route::get('get_culture_options','CultureOptionsController@ajax')->name('culture_options.ajax');
   
    //groups
    Route::resource('groups','GroupsController');
    Route::post('groups/delete_analysis/{id}','GroupsController@delete_analysis');
    Route::get('get_groups','GroupsController@ajax')->name('get_groups');
    Route::post('groups/print_barcode/{group_id}','GroupsController@print_barcode')->name('groups.print_barcode');
   
    //doctors 
    Route::resource('doctors','DoctorsController');
    Route::get('get_doctors','DoctorsController@ajax')->name('get_doctors');
    Route::get('doctors_export','DoctorsController@export')->name('doctors.export'); 
    Route::get('doctors_download_template','DoctorsController@download_template')->name('doctors.download_template'); 
    Route::post('doctors_import','DoctorsController@import')->name('doctors.import'); 

    //reports
    Route::resource('reports','ReportsController');
    Route::post('reports/pdf/{id}','ReportsController@pdf')->name('reports.pdf');
    Route::post('reports/update_culture/{id}','ReportsController@update_culture')->name('reports.update_culture');//update cultures
    Route::get('get_reports','ReportsController@ajax')->name('get_reports');
    Route::get('sign_report/{id}','ReportsController@sign')->name('reports.sign');
    
    //roles
    Route::resource('roles','RolesController');
    Route::get('get_roles','RolesController@ajax')->name('get_roles');

    //users
    Route::resource('users','UsersController');
    Route::get('get_users','UsersController@ajax')->name('get_users');
   
    //tests price list
    Route::get('prices/tests','PricesController@tests')->name('prices.tests');
    Route::post('prices/tests','PricesController@tests_submit')->name('prices.tests_submit');
    Route::get('tests_prices_export','PricesController@tests_prices_export')->name('prices.tests_prices_export'); 
    Route::post('tests_prices_import','PricesController@tests_prices_import')->name('prices.tests_prices_import'); 
  
    //cultures price list
    Route::get('prices/cultures','PricesController@cultures')->name('prices.cultures');
    Route::post('prices/cultures','PricesController@cultures_submit')->name('prices.cultures_submit');
    Route::get('cultures_prices_export','PricesController@cultures_prices_export')->name('prices.cultures_prices_export'); 
    Route::post('cultures_prices_import','PricesController@cultures_prices_import')->name('prices.cultures_prices_import'); 
    
    //accounting reports
    Route::get('accounting','AccountingController@index')->name('accounting.index');
    Route::get('generate_report','AccountingController@generate_report')->name('accounting.generate_report');
    Route::get('doctor_report','AccountingController@doctor_report')->name('accounting.doctor_report');
    Route::get('generate_doctor_report','AccountingController@generate_doctor_report')->name('accounting.generate_doctor_report');
    
    //chat
    Route::get('chat','ChatController@index')->name('chat.index');
   
    //visits
    Route::resource('visits','VisitsController');
    Route::get('visits/create_tests/{id}','VisitsController@create_tests')->name('visits.create_tests');
    Route::get('get_visits','VisitsController@ajax')->name('get_visits');
   
    //branches
    Route::resource('branches','BranchesController');
    Route::get('get_branches','BranchesController@ajax')->name('get_branches');
    
    //contracts
    Route::resource('contracts','ContractsController');
    Route::get('get_contracts','ContractsController@ajax')->name('get_contracts');
   
    //expenses
    Route::resource('expenses','ExpensesController');
    Route::get('get_expenses','ExpensesController@ajax')->name('get_expenses');
    
    //expense categories
    Route::resource('expense_categories','ExpenseCategoriesController');
    Route::get('get_expense_categories','ExpenseCategoriesController@ajax')->name('get_expense_categories');

    //backups
    Route::resource('backups','BackupsController');

    //activity logs
    Route::resource('activity_logs','ActivityLogsController');
    Route::post('activity_logs_clear','ActivityLogsController@clear')->name('activity_logs.clear');
    Route::get('get_activity_logs','ActivityLogsController@ajax')->name('get_activity_logs');

    //settings
    Route::group(['prefix'=>'settings','as'=>'settings.'],function(){
        Route::get('/','SettingsController@index')->name('index');
        Route::post('info','SettingsController@info_submit')->name('info_submit');
        Route::post('emails','SettingsController@emails_submit')->name('emails_submit');
        Route::post('reports','SettingsController@reports_submit')->name('reports_submit');
        Route::post('sms','SettingsController@sms_submit')->name('sms_submit');
        Route::post('whatsapp','SettingsController@whatsapp_submit')->name('whatsapp_submit');
        Route::post('api_keys','SettingsController@api_keys_submit')->name('api_keys_submit');
    });

    //translations
    Route::resource('translations','TranslationsController');
});

?>