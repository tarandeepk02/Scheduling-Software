<?php

/*Route::get('/home', function () {
    $users[] = Auth::user();
    $users[] = Auth::guard()->user();
    $users[] = Auth::guard('employee')->user();

    //dd($users);

    return view('employee.home');
})->name('home');*/

Route::get('home', 'EmployeeController@dashboard')->name('home');

Route::get('profile', 'EmployeeController@profile')->name('profile');
Route::post('profile', 'EmployeeController@profile_update')->name('profile.update');

Route::get('password', 'EmployeeController@password')->name('password');
Route::post('password', 'EmployeeController@password_update')->name('password.update');

Route::post('eworkorder/selectorder/{id}', 'Resource\EworkorderResource@selectOrder')->name('eworkorder.selectorder');
Route::post('eworkorder/startorder/{id}', 'Resource\EworkorderResource@startOrder')->name('eworkorder.startorder');
Route::post('eworkorder/completeorder/{id}', 'Resource\EworkorderResource@completeOrder')->name('eworkorder.completeorder');
Route::post('eworkorder/submitreportStore', 'Resource\EworkorderResource@submitreportStore')->name('eworkorder.submitreportStore');
Route::get('eworkorder/submitreport/{id}', 'Resource\EworkorderResource@submitreport')->name('eworkorder.submitreport');
Route::resource('eworkorder', 'Resource\EworkorderResource');