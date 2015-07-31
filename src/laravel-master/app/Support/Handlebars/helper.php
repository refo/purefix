<?php

if (!function_exists('hbs')) {

    function hbs($template, $viewData = [])
    {
        $hbs = app('Handlebars');
        return $hbs->render($template, $viewData);
    }
}
