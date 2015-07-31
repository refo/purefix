<?php

namespace App\Support\Handlebars;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

use Handlebars\Handlebars;
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
            
            return new Handlebars([
                'loader'          => $loader,
                'partials_loader' => $loader,
            ]);

        });

        include_once 'helper.php';
    }
    
}
