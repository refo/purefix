<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

use Handlebars\Handlebars;
use Handlebars\Loader\FilesystemLoader as HandlebarsLoader;

abstract class Controller extends BaseController
{
    use DispatchesJobs, ValidatesRequests;

    protected $hb;
    protected $hbPath;

    protected $layout = '';
    protected $view = '';
    protected $meta = [
        'titlePrefix' => '',
        'title' => '',
        'titleSuffix' => '',

    ];

    public function __construct()
    {
        $this->meta['titleSuffix'] = ' - Pure Fix Türkiye';
        
        $this->hbPath = app_path('views');

        $hbLoader = new HandlebarsLoader($this->hbPath, ['extension'=>'html']);
        $hb = new Handlebars([
            'loader' => $hbLoader,
            'partials_loader' => $hbLoader,
        ]);

        $this->hb = $hb;
    }

    protected function createResponse($view = '', $data = [], $layout = null)
    {
        if (is_null($layout)) $layout = $this->layout;
        
        $data = [
            'meta' => $this->meta,
            'data' => $data,
        ];

        $view = $this->hb->render($view, $data);

        $data['content'] = $view;

        return $this->hb->render($layout, $data);
    }


}

