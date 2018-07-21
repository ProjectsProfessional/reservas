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

Route::get('/users/{user}','UserController@details')
    ->where('user','\d+')
    ->name('users.details');


Route::get('/nuevasHabitaciones','nuevaHabitacionController@index')
 ->name('nuevasHabitaciones');
 Route::get('/nuevasHabitaciones/create','nuevaHabitacionController@create')
 ->name('nuevasHabitaciones.create');
Route::post('/nuevasHabitaciones','nuevaHabitacionController@store');
Route::put('/nuevasHabitaciones/{habitaciones}','nuevaHabitacionController@update');
Route::get('/nuevasHabitaciones/{habitacion}','nuevaHabitacionController@details')
->where('habitacion','\d+')
->name('nuevasHabitaciones.details');


 #Estado de habitaciones routes
 Route::get('/estados','EstadoHabitacionController@index')
	->name('estados');

 Route::get('/estados/create','EstadoHabitacionController@create')
	->name('estados.create');

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

Route::post('/tiposHabitaciones','tipoHabitacionController@store');
Route::put('/tiposHabitaciones/{tipo}','tipoHabitacionController@update');

Route::get('/tiposHabitaciones/{tipo}','tipoHabitacionController@details')
  ->where('tipo','\d+')
  ->name('tiposHabitaciones.details');
#IMPUESTOS ROUTES
Route::get('/impuestos','ImpuestoController@index')
 ->name('impuestos');

Route::get('/impuestos/create','ImpuestoController@create')
 ->name('impuestos.create');

Route::post('/impuestos','ImpuestoController@store');
Route::put('/impuestos/{impuesto}','ImpuestoController@update');
Route::get('/impuestos/{impuesto}','ImpuestoController@details')
 ->where('impuesto','\d+')
 ->name('impuestos.details');
#CLIENT ROUTES
Route::get('/clients','ClientController@index')
    ->name('clients');

Route::get('/clients/create','ClientController@create')
    ->name('clients.create');

Route::post('/clients','ClientController@store');
#Ruta del boton update
Route::put('/clients/{client}','ClientController@update');
Route::get('/clients/{client}','ClientController@details')
    ->where('client','\d+')
    ->name('clients.details');

//Rutas de fuentes de reservas
Route::get('/fuentes','fuenteReservaController@index')
    ->name('fuentes');

Route::get('/fuentes/create','fuenteReservaController@create')
    ->name('fuentes.create');

Route::post('/fuentes','fuenteReservaController@store');
#Ruta del boton update
Route::put('/fuentes/{fuente}','fuenteReservaController@update');
Route::get('/fuentes/{fuente}','fuenteReservaController@details')
    ->where('fuente','\d+')
    ->name('fuentes.details');

#Reservas ROUTES
Route::get('/reservas','ReservaController@index')
    ->name('reservas');

Route::get('/reservas/create','ReservaController@create')
    ->name('reservas.create');

Route::post('/reservas','ReservaController@store');
Route::put('/reservas/{reserva}','ReservaController@update');

Route::get('/reservas/{reserva}','ReservaController@details')
    ->where('reserva','\d+')
    ->name('reservas.details');

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
