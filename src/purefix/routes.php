<?php

Route::get('/', 'PageController@getIndex');

Route::get('test', function(){
    return 'TEST OK';
});

Route::get('products', 'ProductController@all');

Route::controller('page', 'PageController');

Route::controller('test', 'TestController');
