<?php
use Illuminate\Support\Facades\Route;
/*Route::get('/home', function () {
    $users[] = Auth::user();
    $users[] = Auth::guard()->user();
    $users[] = Auth::guard('admin')->user();

    //dd($users);

    return view('admin.home');
})->name('home');*/


Route::get('/', 'AdminController@dashboard')->name('index');
//Route::get('/', 'AdminController@dashboard')->name('index');
Route::get('/home', 'AdminController@dashboard');
Route::get('/dashboard', 'AdminController@dashboard');

Route::get('/history', 'AdminController@history');

Route::get('profile', 'AdminController@profile')->name('profile');
Route::post('profile', 'AdminController@profile_update')->name('profile.update');

Route::get('password', 'AdminController@password')->name('password');
Route::post('password', 'AdminController@password_update')->name('password.update');

Route::resource('admin', 'Resource\AdminResource');

Route::get('employee/uptStatus/{id}/{status}', 'Resource\EmployeeResource@uptStatus')->name('employee.uptStatus');
Route::resource('employee', 'Resource\EmployeeResource');

Route::get('client/uptStatus/{id}/{status}', 'Resource\ClientResource@uptStatus')->name('client.uptStatus');
Route::resource('client', 'Resource\ClientResource');



Route::post('task/dropEvent', 'Resource\TaskResource@dropEvent')->name('task.dropEvent');
Route::post('task/getJobs', 'Resource\TaskResource@getJobs')->name('task.getJobs');

Route::get('task/event/{id}/{type}', 'Resource\TaskResource@eventDetails')->name('task.event');
Route::get('task/resourcesEmployees', 'Resource\TaskResource@resourcesEmployees')->name('task.resourcesEmployees');
Route::get('task/eventsEmployees', 'Resource\TaskResource@eventsEmployees')->name('task.eventsEmployees');
Route::get('task/schedule', 'Resource\TaskResource@schedule')->name('task.schedule');
Route::get('task/uptStatus/{id}/{status}', 'Resource\TaskResource@uptStatus')->name('task.uptStatus');
Route::post('task/updateTime', 'Resource\TaskResource@updateTime')->name('task.updateTime');
Route::resource('task', 'Resource\TaskResource');






Route::get('job/event/{id}', 'Resource\JobResource@eventDetails')->name('job.event');
Route::get('job/schedule/events', 'Resource\JobResource@calendarEvents')->name('job.schedule.events');
Route::get('job/schedule', 'Resource\JobResource@schedule')->name('job.schedule');
Route::get('job/uptStatus/{id}/{status}', 'Resource\JobResource@uptStatus')->name('job.uptStatus');
Route::resource('job', 'Resource\JobResource');






Route::get('user/uptStatus/{id}/{status}', 'Resource\UserResource@uptStatus')->name('user.uptStatus');
Route::resource('user', 'Resource\UserResource');

Route::get('receipt/print/{id}', 'Resource\ReceiptResource@printOrder')->name('receipt.print');
Route::resource('receipt', 'Resource\ReceiptResource');


Route::resource('board', 'Resource\BoardResource');








Route::get('customer/uptStatus/{id}/{status}', 'Resource\CustomerResource@uptStatus')->name('customer.uptStatus');
Route::resource('customer', 'Resource\CustomerResource');

Route::resource('vehicle', 'Resource\VehicleResource');

/*Route::post('workorder/loadCustomerData', 'Resource\WorkorderResource@loadCustomerData');

Route::post('workorder/loadVehicles', 'Resource\WorkorderResource@loadVehicles');
Route::post('workorder/loadVehicleData', 'Resource\WorkorderResource@loadVehicleData');*/



Route::resource('workorder', 'Resource\WorkorderResource');

Route::resource('work', 'Resource\WorkResource');

Route::get('report/employee', 'Resource\ReportResource@employeeReport')->name('report.employee');
Route::get('report/donor', 'Resource\ReportResource@donorReport')->name('report.donor');
Route::resource('report', 'Resource\ReportResource');







Route::resource('setting', 'Resource\SettingResource');

Route::resource('employer', 'Resource\EmployerResource');
Route::resource('industry', 'Resource\IndustryResource');

Route::resource('prospect', 'Resource\ProspectResource');


Route::get('weeklyprospect/search', 'Resource\WeeklyprospectResource@search');
Route::post('weeklyprospect/search', 'Resource\WeeklyprospectResource@searchresults');
/*Won*/

/*Drip*/
Route::post('weeklyprospect/drip', 'Resource\WeeklyprospectResource@dripPost');

Route::get('wonprospect', 'Resource\WeeklyprospectResource@wonprospect');
Route::get('dripprospect', 'Resource\WeeklyprospectResource@dripprospect');

Route::get('weeklyprospect/uploadcsv', 'Resource\WeeklyprospectResource@uploadcsv')->name('weeklyprospect.uploadcsv');
Route::post('weeklyprospect/csvdata', 'Resource\WeeklyprospectResource@csvdata')->name('weeklyprospect.csvdata');

Route::post('weeklyprospect/updatecsvdata', 'Resource\WeeklyprospectResource@updatecsvdata')->name('weeklyprospect.updatecsvdata');

Route::post('weeklyprospect/deleteAll', 'Resource\WeeklyprospectResource@deleteall');
Route::resource('weeklyprospect', 'Resource\WeeklyprospectResource');
//Route::resource('subadmin', 'Resource\UserResource');



Route::resource('material', 'Resource\MaterialResource');



Route::get('stripe', array('as' => 'paywithstripe','uses' => 'AddMoneyController@payWithStripe'));
Route::post('stripe', array('as' => 'stripe','uses' => 'AddMoneyController@postPaymentWithStripe'));
Route::get('success', 'AddMoneyController@success');
Route::get('cancel', 'AddMoneyController@cancel');
