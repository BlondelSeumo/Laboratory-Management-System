<?php

//patient authentication
Route::group(['namespace'=>'Auth','prefix'=>'/','middleware'=>'PatientGuest','as'=>'patient.auth.'],function(){
  //register
  Route::get('register','PatientController@showRegistrationForm')->name('register');
  Route::post('register_submit','PatientController@register_submit')->name('register_submit');
  //login
  Route::get('/','PatientController@showLoginForm')->name('login');
  Route::post('/login_submit','PatientController@login_submit')->name('login_submit');
  //send mail patient code
  Route::get('/mail','PatientController@showMailForm')->name('mail');
  Route::post('/mail_submit','PatientController@mail_submit')->name('mail_submit');
  //quick login patient
  Route::get('patient/login/{code}','PatientController@login_patient')->name('login_by_code');
});
//logout patient
Route::post('/logout','Auth\PatientController@logout')->name('patient.logout');

//patient pages
Route::group(['namespace'=>'Patient','prefix'=>'patient','middleware'=>'Patient','as'=>'patient.'],function(){
  //dashboard
  Route::get('/','IndexController@index')->name('index');
 
  //get reports and receipts
  Route::group(['prefix'=>'groups','as'=>'groups.'],function(){
    Route::get('/','GroupsController@index')->name('index');
    Route::get('/reports/{id}','GroupsController@reports')->name('reports');
    Route::get('/receipt/{id}','GroupsController@receipt')->name('receipt');
    Route::post('/reports/pdf/{id}','GroupsController@pdf')->name('pdf');
  });
  //get patient groups
  Route::get('get_patient_groups','GroupsController@ajax')->name('get_patient_groups');

  //profile
  Route::group(['prefix'=>'profile','as'=>'profile.'],function(){
    Route::get('/','ProfileController@edit')->name('edit');
    Route::post('/','ProfileController@update')->name('update');
  });

  //visits
  Route::resource('visits','VisitsController');

  //branches
  Route::resource('branches','BranchesController');

  //tests library
  Route::resource('tests_library','TestsLibraryController');
  Route::get('get_analyses','TestsLibraryController@get_analyses');
  Route::get('get_cultures','TestsLibraryController@get_cultures');

});




?>