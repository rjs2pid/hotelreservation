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

Route::get('/','PagesController@index');
Route::get('/contact','PagesController@contact');
Route::get('/gallery','PagesController@gallery');
Route::get('/tarrif','PagesController@tarrif');
Route::get('/roomresult','PagesController@roomResult');
Route::get('/results','RoomController@getDates');
Route::get('/resultsAdmin/{checkindate}','RoomController@getResults');
Route::get('/roomDetailsAdmin','RoomController@roomdetailsAdmin');

Route::get('/roomManagement','RoomController@roomManagement');

Route::get('/addReservationAdminView','RoomController@addReservationAdminView');
Route::post('/saveNewReservation','BookingController@saveNewReservation');

Route::post('/payments','PaymentController@storeTrans');

Route::get('/rooms','RoomController@index');
Route::get('/roombooking/{roomid}/{checkindate}/{checkoutdate}','RoomController@create');
Route::get('/getRequests','BookingController@getRequests');

Route::post('/createbooking','BookingController@store');

Route::get('/calendar','BookingController@calendar');
//Route::pos/t('/itinerary','PagesController@itineray');


/*** Reservation Routes()
 * 
 * 
 * 
 */

Route::get('/arrivals','BookingController@arrivals');
Route::get('/arrivalcount','BookingController@arrivalCount');

Route::get('/departures','BookingController@departures');
Route::get('/departurecount','BookingController@departureCount');

Route::get('/newReservations','BookingController@newReservations');
Route::get('/newReservationsCount','BookingController@newReservationsCount');

Route::get('/departures','BookingController@departures');
Route::get('/bookings','BookingController@index');

Route::get('/todaysguest','BookingController@todaysguest');




/*** Room Routes()
 * 
 * 
 * 
 */

 Route::get('/roommanagement','RoomController@roommanagement');
 Route::get('/viewroom/{roomid}','RoomController@viewroom');

 Route::post('updateroom','RoomController@updateroom');

 Route::get('/roomstatus/{roomid}','RoomController@roomstatus');

Route::get('/bookingdetails/{referencenumber}','BookingController@show');

Route::get('/xx','RoomController@lastid');
Route::get('itinerary','BookingController@itinerary');

Route::post('/zz','BookingController@testsss');

Route::get('/t','RoomController@testx');
Route::get('/informationreview','BookingController@formreview');
Route::get('/yourItinerary','BookingController@viewBookings');
Route::get('/bookingPDF','ReportController@itineraryReport');
Route::get('/loader','ReportController@loader');



Route::get('/addReservation_admin','PagesController@addReservation_admin');
Route::get('/noShow','BookingController@noShow');
Route::get('/checkin','BookingController@checkin');
Route::get('/requests','RequestController@additional');


Route::get('/checkout','ReportController@checkout');
Route::get('checkedoutlists','BookingController@checkedoutlists');

Route::get('/checkedoutdetails/{referencenumber}','BookingController@showcheckedoutdetails');
Route::get('/Print','ReportController@itineraryReport');
Route::get('/Reprint','ReportController@itineraryReportxx');




/******Routes for Promos
 * 
 * 
*/
Route::get('/Show_Promos','PromoController@showPromos');
Route::get('/Edit_Promo/{promocode}','PromoController@ManagePromo');
Route::get('/Delete_Promo/{promocode}','PromoController@DeletePromo');
Route::get('/Create_Promo','PromoController@CreatePromo');


/*END ROUTES FOR PROMOS*/


//Route::get('/getdetails',function(){
//if (Request::ajax()){
//return 'success';


   // }

//});
Route::get('/login','HomeController@loginpage');
Route::get('adduser','HomeController@createuser');
Auth::routes();

Route::get('/frontoffice', 'HomeController@index');



