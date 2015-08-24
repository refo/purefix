<?php

namespace Purefix\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

use Request;

abstract class Controller extends BaseController
{
    use DispatchesJobs, ValidatesRequests;

    protected $layout = 'layout/default';
    protected $view   = '';
    
    protected $meta = [
        'titlePrefix' => '',
        'title'       => '',
        'titleSuffix' => '',
        'version'     => APP_VERSION,
    ];

    public $urls = [];

    public function __construct()
    {
        $this->meta['titleSuffix'] = ' - Pure Fix Türkiye';

        $this->urls = [
            'home'      => route('home'),
            'products'  => route('products'),
            'contact'   => route('contact'),
            'servisler' => route('servisler'),
            'satis'     => route('satis'),
            'videos'    => route('videos'),
            'glow'      => route('products', 'purefix-glow'),
            'sale'      => route('sale'),
        ];
    }

    protected function layout($content = '')
    {
        $layout = hbs($this->layout, [
            'meta'    => $this->meta,
            'url'     => $this->urls,
            'content' => $content,
        ]);

        return $layout;
    }

}

