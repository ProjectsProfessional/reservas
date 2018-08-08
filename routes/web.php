<?php
#lOGIN ROUTES
Route::get('/', 'Auth\LoginController@showLoginForm')
    ->name('login');
Route::post('login','Auth\LoginController@login')
    ->name('login');
Route::post('logout','Auth\LoginController@logout')
    ->name('logout');
    Route::get('/', 'Auth\LoginController@showLoginForm')
        ->name('login');
Route::get('/welcome','WelcomeController@index')
    ->name('welcome');
#Usuarios
Route::get('/users','UserController@index')
    ->name('users');
Route::get('/users/create','UserController@create')
    ->name('users.create');
Route::post('/users','UserController@store');

Route::put('/users/{user}','UserController@update');

Route::delete('/users/{user}','UserController@destroy')
    ->name('user.destroy');

Route::post('/users/changePassword','UserController@changePassword')->name('user.password');

Route::get('/users/{user}','UserController@details')
    ->where('user','\d+')
    ->name('users.details');
Route::get('/nuevasHabitaciones','nuevaHabitacionController@index')
 ->name('nuevasHabitaciones');
 Route::delete('/nuevasHabitaciones/{habitacion}','nuevaHabitacionController@destroy')
 ->name('nuevasHabitaciones.destroy');
 Route::get('/nuevasHabitaciones/create','nuevaHabitacionController@create')
 ->name('nuevasHabitaciones.create');
Route::post('/nuevasHabitaciones','nuevaHabitacionController@store');
Route::put('/nuevasHabitaciones/{habitaciones}','nuevaHabitacionController@update');
Route::get('/nuevasHabitaciones/{habitacion}','nuevaHabitacionController@details')
->where('habitacion','\d+')
->name('nuevasHabitaciones.details');

Route::get('/precio','priceController@index')
    ->name('precio');
Route::get('/precio/create','priceController@create')
    ->name('precio.create');
Route::any('/precio','priceController@destroy')->name('deletePrice');
Route::post('/precio','priceController@store');
Route::put('/precio/{price}','priceController@update');

Route::get('/precio/{price}','priceController@details')
    ->where('precio','\d+')
    ->name('precio.details');

 #Estado de habitaciones routes
 Route::get('/estados','EstadoHabitacionController@index')
	->name('estados');
 Route::get('/estados/create','EstadoHabitacionController@create')
	->name('estados.create');
Route::delete('/estados/{estado}','EstadoHabitacionController@destroy')
     ->name('estados.destroy');
 Route::post('/estados','EstadoHabitacionController@store');
 #Ruta del boton update
 Route::put('/estados/{estado}','EstadoHabitacionController@update');
 Route::get('/estados/{estado}','EstadoHabitacionController@details')
	->where('estado','\d+')
	->name('estados.details');
#############################################
#MEDIA ROUTES
Route::get('/habitaciones','habitacionesController@index')
 ->name('habitaciones');
 Route::get('/habitaciones{habitaciones}','habitacionesController@details')
  ->name('habitaciones.details');
#CURRENCIES ROUTES
Route::get('/currencies','CurrencyController@index')
    ->name('currencies');
Route::get('/currencies/create','CurrencyController@create')
    ->name('currencies.create');
Route::delete('/currencies/{currency}','CurrencyController@destroy')
    ->name('currencies.destroy');
Route::post('/currencies','CurrencyController@store');
Route::put('/currencies/{currency}','CurrencyController@update');
Route::get('/currencies/{currency}','CurrencyController@details')
    ->where('currency','\d+')
    ->name('currencies.details');
#tTIPOSHABITACIONES ROUTES
Route::get('/tiposHabitaciones','tipoHabitacionController@index')
  ->name('tiposHabitaciones');
Route::get('/tiposHabitaciones/create','tipoHabitacionController@create')
  ->name('tiposHabitaciones.create');
  Route::delete('/tiposHabitaciones/{tipo}','tipoHabitacionController@destroy')
      ->name('tiposHabitaciones.destroy');
Route::post('/tiposHabitaciones','tipoHabitacionController@store')->name("saveRooms");
Route::put('/tiposHabitaciones','tipoHabitacionController@update')
->name('updateRooms');
Route::get('/tiposHabitaciones/{tipo}','tipoHabitacionController@details')
  ->where('tipo','\d+')
  ->name('tiposHabitaciones.details');
#IMPUESTOS ROUTES
Route::get('/impuestos','ImpuestoController@index')
 ->name('impuestos');
Route::get('/impuestos/create','ImpuestoController@create')
 ->name('impuestos.create');
Route::post('/impuestos','ImpuestoController@store');
Route::delete('/impuestos/{impuesto}','ImpuestoController@destroy')
->name('impuestos.destroy');
Route::put('/impuestos/{impuesto}','ImpuestoController@update');
Route::get('/impuestos/{impuesto}','ImpuestoController@details')
 ->where('impuesto','\d+')
 ->name('impuestos.details');
#CLIENT ROUTES
Route::get('/clients','CustomerController@index')
    ->name('clients');
Route::get('/clients/create','CustomerController@create')
    ->name('clients.create');
Route::delete('/clients/{client}','CustomerController@destroy')
	->name('clients.destroy');
Route::post('/clients','CustomerController@store');
Route::post('/price-available','CustomerController@isPreferentialCustomer')
    ->name('reservas.modify-prices');
#Ruta del boton update
Route::put('/clients/{client}','CustomerController@update');
Route::get('/clients/{client}','CustomerController@details')
    ->where('client','\d+')
    ->name('clients.details');
//Rutas de fuentes de reservas
Route::get('/fuentes','fuenteReservaController@index')
    ->name('fuentes');
Route::get('/fuentes/create','fuenteReservaController@create')
    ->name('fuentes.create');
Route::post('/fuentes','fuenteReservaController@store');
Route::delete('/fuentes/{fuente}','fuenteReservaController@destroy')
 ->name('fuentes.destroy');
Route::put('/fuentes/{fuente}','fuenteReservaController@update');
Route::get('/fuentes/{fuente}','fuenteReservaController@details')
    ->where('fuente','\d+')
    ->name('fuentes.details');
#Reservas ROUTES
Route::get('/reservas','ReservaController@index')
    ->name('reservas');

Route::post('/reservas/create','ReservaController@create')
    ->name('reservas.create');

Route::post('/reservas','ReservaController@store')
    ->name('reservas.save');

Route::post('/reservas/pay','ReservaController@pay')
    ->name('reserva.pay');

Route::post('/reservas/cancel','ReservaController@cancel')
    ->name('reserva.cancel');

Route::post('/reservas','ReservaController@store')
    ->name('reservas.save');

Route::delete('/reservas/{reserva}','ReservaController@destroy')
 	->name('reservas.destroy');

Route::put('/reservas/{reserva}','ReservaController@update');

Route::get('/reservas/{reserva}','ReservaController@details')
    ->where('reserva','\d+')
    ->name('reservas.details');

Route::get('/reservas/disponibilidad',function(){
    return view('reservas.available');
})->name('reservas.available');
###########################################################
//REPORTES
Route::get('/reports/dailyReport','dailyReportController@index')
    ->name('reports.daily');
Route::get('/reports/dailyReport/{option}','dailyReportController@generatePDF');
Route::get('/reports/byDate','byDateReportController@index')
    ->name('reports.byDate');
Route::post('/reports/byDate','byDateReportController@generatePDF');
Route::get('/reports/byPartner','byPartnerReportController@index')
    ->name('reports.byPartner');
Route::post('/reports/byPartner','byPartnerReportController@generatePDF');
Route::get('/reports/byCurrency','byCurrencyReportController@index')
    ->name('reports.byCurrency');
Route::post('/reports/byCurrency','byCurrencyReportController@generatePDF');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
