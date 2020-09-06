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
    return redirect()->route('tienda');
});

Route::bind('producto', function($slug){
  return DB::table('productos')->where('id', '=', $slug)->first();
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth', 'rol:admin']], function(){
  Route::get('productos', 'AdminController@productos')->name('productos');
  Route::post('productos-guardar', 'AdminController@productosGuardar')->name('productosGuardar');
});

Route::get('/', 'TiendaController@index')->name('tienda');
Route::get('show/carrito', 'TiendaController@showCarrito')->name('showCarrito');
Route::get('add/carrito/{producto}', 'TiendaController@addProducto')->name('addProducto');
Route::get('eliminar/producto/{producto}', 'TiendaController@eliminarProducto')->name('eliminarProducto');
Route::get('actualizar/carrito/{producto?}/{cantidad?}', 'TiendaController@actualizarCantidad')->name('actualizarCantidad');
Route::get('checkout', 'TiendaController@checkout')->name('checkout');
Route::get('nosotros', 'TiendaController@nosotros')->name('nosotros');
Route::get('contacto', 'TiendaController@contacto')->name('contacto');
