<?php

Route::get('/', [
    'as' => 'home', 'uses' => 'PageController@index'
]);

Route::get('iletisim', [
    'as' => 'contact', 'uses' => 'PageController@contact'
]);

Route::get('servis-noktalari', [
    'as' => 'servisler', 'uses' => 'PageController@servisler'
]);

Route::get('bisikletler/{collection?}', [
    'as' => 'products', 'uses' => 'ProductController@index'
]);

Route::get('bisiklet/{slug}', [
    'as' => 'product', 'uses' => 'ProductController@detail'
]);

Route::get('pure-fix-tv', [
    'as' => 'videos', 'uses' => 'PageController@videos'
]);

Route::get('firsat', [
    'as' => 'sale', 'uses' => 'ProductController@sale'
]);


Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function(){

    Route::resource('product', 'ProductAdmin');
    Route::resource('product.variants', 'ProductVariantsAdmin');

});


//Route::controller('page', 'PageController');

//Route::controller('test', 'TestController');
