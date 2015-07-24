<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('test', function(){
    return 'TEST OK';
});

Route::controller('page', 'PageController');
