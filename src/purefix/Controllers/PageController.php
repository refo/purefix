<?php

namespace Purefix\Controllers;

use Purefix\Models\Product;

class PageController extends Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $products = Product::take(6)->get();
        
        $products->map(function($item){
            $item->url = route('product', $item->slug);
            return $item;
        });

        $view = hbs('content/product-list', [
            'title' => 'Bisikletin Yalın Hali',
            'list'  => $products->toArray(),
            'more'  => [
                'title' => 'Hepsini Göreyim',
                'url'   => $this->urls['products'],
            ],
        ]);

        
        
        
        
        $billboardImages = [
            [
                'filename' => 'Bradley_MG_0056.jpg',
                'style'    => 'margin-top:-25%'
            ],
            [
                'filename' => 'delta-lifestyle-5_2048x2048.jpg',
                'style'    => 'margin-top:-20%'
            ],
            [
                'filename' => 'IMG_3639.jpg',
                'style'    => 'margin-top:-20%'
            ],
            [
                'filename' => 'ZULU_WEB_0005.jpg',
                'style'    => 'margin-top:-20%'
            ],
        ];

        $image = array_rand($billboardImages);
        $image = $billboardImages[$image];

        $billboardView = hbs('part/billboard', [
            'urls' => $this->urls,
            'image' => $image, 
        ]);

        $this->meta['title'] = 'Merhaba';

        return $this->layout($billboardView . $view);
    }

    public function contact()
    {
        return $this->layout('<h1>İletişim</h1>');
    }

    public function servisler()
    {
        $servisler = require CUSTOMER_PATH . '/storage/' . 'servisler.php';
        $view = hbs('content/servisler', $servisler);

        return $this->layout($view);

    }
    
}
