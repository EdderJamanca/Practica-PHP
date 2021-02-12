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
    return view('plantilla');
});

// Route::view('/','paginas.blog');
// Route::view('/administradores','paginas.administrador');
// Route::view('/categoria','paginas.categoria');
// Route::view('/articulos','paginas.articulos');
// Route::view('/banner','paginas.banner');
// Route::view('/anuncios','paginas.anuncios');
//
//
// Route::get('/', 'BlogController@traerBlog');
// Route::get('/categoria', 'CategoriaController@traerCategoria');
// Route::get('/banner','BannerController@traerBanner');
// Route::get('/articulos','ArticulosController@traerArticulos');
// Route::get('/anuncios','AnunciosController@tarerAnuncio');
// Route::get('/administradores','AdministradorController@traerAdministracion');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/', 'BlogController');
Route::resource('/blog', 'BlogController');
Route::resource('/categoria', 'CategoriaController');
Route::resource('/banner','BannerController');
Route::resource('/articulos','ArticulosController');
Route::resource('/anuncios','AnunciosController');
Route::resource('/administradores','AdministradorController');
