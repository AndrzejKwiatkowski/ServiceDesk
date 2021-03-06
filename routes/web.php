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


Auth::routes(['register' => false]);
Route::get('tickets/my-tickets', 'TicketController@ticketuser')->name('ticketuser');
Route::put('/tickets/{ticket}/change', 'TicketController@changestatus')->name('changestatus');
Route::resource('/tickets/{ticket}/attachments', 'AttachmentController');




Route::resource('tickets', 'TicketController');
Route::resource('tickets/{ticket}/comments', 'CommentController');
Route::resource('tickets/{ticket}/solutions', 'SolutionController');

