<?php

namespace Purefix\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

use Request;

abstract class Controller extends BaseController
{
    use DispatchesJobs, ValidatesRequests;

    protected $layout = '';
    protected $view   = '';
    
    protected $meta = [
        'titlePrefix' => '',
        'title' => '',
        'titleSuffix' => '',

    ];

    public function __construct()
    {
        $this->meta['titleSuffix'] = ' - Pure Fix Türkiye';
    }

}

