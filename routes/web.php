<?php

use Illuminate\Support\Facades\Route;

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
    return view('index');
});


// Rotas Produtos
Route::get('/produtos', 'ProdutosController@indexView');
// Route::get('/produtos/novoproduto', 'ProdutosController@create');
// Route::post('/produtos', 'ProdutosController@store');
// Route::get('/produtos/editar/{id}', 'ProdutosController@edit');
// Route::post('/produtos/{id}', 'ProdutosController@update');
// Route::get('/produtos/excluir/{id}', 'ProdutosController@destroy');


// Rotas Categorias
Route::get('/categorias', 'CategoriasController@index');
Route::get('/categorias/novacategoria', 'CategoriasController@create');
Route::post('/categorias', 'CategoriasController@store');
Route::get('/categorias/excluir/{id}', 'CategoriasController@destroy');
Route::get('/categorias/editar/{id}', 'CategoriasController@edit');
Route::post('/categorias/{id}', 'CategoriasController@update');