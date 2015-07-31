<?php

namespace Purefix\Controllers;

use Purefix\Models\Product;

class PageController extends Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function getIndex()
    {
        $products = Product::take(6)->get()->toArray();
    
        $view = hbs('content/product-list', [
            'title' => 'Bisikletin Yalın Hali',
            'list'  => $products,
            'more'  => [
                'title' => 'Hepsini Göreyim',
                'url'   => 'products',
            ],
        ]);

        $this->meta['title'] = 'Merhaba';

        $layout = hbs('layout/default', [
            'meta'    => $this->meta,
            'content' => $view,
        ]);

        return $layout;
    }
    
}
