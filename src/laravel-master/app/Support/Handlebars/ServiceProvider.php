<?php

namespace App\Support\Handlebars;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

use Handlebars\Handlebars;
use Handlebars\Helpers;
use Handlebars\Loader\FilesystemLoader as HandlebarsLoader;

class ServiceProvider extends BaseServiceProvider
{

    protected $extension = 'html';

    public function register()
    {
        $this->app->singleton('Handlebars', function ($app) {

            $path = CUSTOMER_PATH.'/views';

            $loader = new HandlebarsLoader($path, [
                'extension' => $this->extension,
            ]);
            
            $hbs = new Handlebars([
                'loader'          => $loader,
                'partials_loader' => $loader,
                'helpers'         => new Helpers([
                    'vimeo' => function($template, $context, $args, $source){
                        $id = $args;
                        return $template->getEngine()->render('partial/vimeo', ['id' => $id]);
                    },
                ]),
            ]);

            return $hbs;

        });

        include_once 'helper.php';
    }

    
}
