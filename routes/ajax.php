<?php
Route::group(['prefix'=>'ajax','as'=>'ajax.'],function(){
   
    //get patients
    Route::get('get_patient_by_code','AjaxController@get_patient_by_code')->name('get_patient_by_code'); 
    Route::get('get_patient_by_name','AjaxController@get_patient_by_name')->name('get_patient_by_name'); 

    //get patient
    Route::get('get_patient','AjaxController@get_patient')->name('get_patient'); 

    //create patient
    Route::post('create_patient','AjaxController@create_patient')->name('create_patient');
   
    //get tests
    Route::get('get_tests','AjaxController@get_tests')->name('get_tests');

    //delete test
    Route::get('delete_test/{test_id}','AjaxController@delete_test')->name('delete_test');

    //delete option
    Route::get('delete_option/{option_id}','AjaxController@delete_option')->name('delete_option');


    //get cultures
    Route::get('get_cultures','AjaxController@get_cultures')->name('get_cultures');

    //get doctors
    Route::get('get_doctors','AjaxController@get_doctors')->name('get_doctors');

    //create doctor
    Route::post('create_doctor','AjaxController@create_doctor')->name('create_doctor');

    //add options
    Route::post('add_sample_type','AjaxController@add_sample_type')->name('add_sample_type');
    Route::post('add_organism','AjaxController@add_organism')->name('add_organism');
    Route::post('add_colony_count','AjaxController@add_colony_count')->name('add_colony_count');
    
    //get roles
    Route::get('get_roles','AjaxController@get_roles')->name('get_roles');  

    //get online users
    Route::get('online','AjaxController@online')->name('online')->middleware('Admin');

    //get chat
    Route::get('get_chat/{id}','AjaxController@get_chat')->name('get_chat')->middleware('Admin');
    Route::get('chat_unread/{id}','AjaxController@chat_unread')->name('chat_unread')->middleware('Admin');
    Route::post('send_message/{id}','AjaxController@send_message')->name('send_message')->middleware('Admin');

    //change visit status
    Route::post('change_visit_status/{id}','AjaxController@change_visit_status')->name('change_visit_status')->middleware('Admin');

    //change lang status
    Route::post('change_lang_status/{id}','AjaxController@change_lang_status')->name('change_lang_status')->middleware('Admin');

    //add category
    Route::post('add_expense_category','AjaxController@add_expense_category')->name('add_expense_category')->middleware('Admin');
    
    //get unread messages
    Route::get('get_unread_messages','AjaxController@get_unread_messages')->name('get_unread_messages')->middleware('Admin');
    Route::get('get_unread_messages_count/{id}','AjaxController@get_unread_messages_count')->name('get_unread_messages_count')->middleware('Admin');
   
    //get my messages
    Route::get('get_my_messages/{id}','AjaxController@get_my_messages')->name('get_my_messages')->middleware('Admin');
   
    //get new visits
    Route::get('get_new_visits','AjaxController@get_new_visits')->name('get_new_visits')->middleware('Admin');
   
    //load more messages
    Route::get('load_more/{user_id}/{message_id}','AjaxController@load_more')->name('load_more')->middleware('Admin');
    
    //get current patient
    Route::get('get_current_patient','AjaxController@get_current_patient')->name('get_current_patient')->middleware('Patient');

});

?>