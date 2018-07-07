<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', function () use ($app) {
    //return $app->version();
    return "<center><h1>Servidor 2</h1><br>Tipos<br>Productos<br>Stocks<br>Carrito</center>";
});

$app->get('/tipos', 'TiposController@index');
$app->get('/tipos/{tipos}', 'TiposController@getTipo');
$app->post('/tipos', 'TiposController@createTipo');
$app->put('/tipos/{tipos}', 'TiposController@updateTipo');
$app->delete('/tipos/{tipos}', 'TiposController@destroyTipo');

$app->get('/productos', 'ProductosController@index');
$app->get('/productos/tipos/{tipos}', 'ProductosController@getTipo');
$app->get('/productos/carrito/{users}', 'ProductosController@getCarrito');
$app->get('/productos/{productos}', 'ProductosController@getProducto');
$app->post('/productos', 'ProductosController@createProducto');
$app->put('/productos/{productos}', 'ProductosController@updateProducto');
$app->delete('/productos/{productos}', 'ProductosController@destroyProducto');

$app->get('/stocks/min', 'StocksController@getminStock');
$app->get('/stocks/listamin', 'StocksController@getlistaminStock');
$app->get('/stocks', 'StocksController@index');
$app->get('/stocks/{stocks}', 'StocksController@getStock');
$app->post('/stocks', 'StocksController@createStock');
$app->put('/stocks/{stocks}', 'StocksController@updateStock');
$app->delete('/stocks/{stocks}', 'StocksController@destroyStock');

$app->get('/carritos', 'CarritosController@index');
$app->get('/carritos/cliente/{users}', 'CarritosController@getCliente');
$app->post('/carritos', 'CarritosController@createCarrito');
$app->delete('/carritos/{carritos}', 'CarritosController@destroyCarrito');