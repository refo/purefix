<?php

Route::get('/', 'PageController@getIndex');

Route::get('test', function(){
    return 'TEST OK';
});

Route::controller('page', 'PageController');

Route::controller('test', 'TestController');
