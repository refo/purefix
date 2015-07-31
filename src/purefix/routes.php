<?php

Route::get('/', [
    'as' => 'home', 'uses' => 'PageController@index'
]);

Route::get('iletisim', [
    'as' => 'contact', 'uses' => 'PageController@contact'
]);

Route::get('bisikletler', [
    'as' => 'products', 'uses' => 'ProductController@all'
]);

Route::get('bisiklet/{slug}', [
    'as' => 'product', 'uses' => 'ProductController@detail'
]);



//Route::controller('page', 'PageController');

//Route::controller('test', 'TestController');
