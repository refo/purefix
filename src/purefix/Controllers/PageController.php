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

        $data = [];

        $data['popular'] = [
            'title' => 'POPÜLER BİSİKLETLER',
            'list'  => $products->toArray(),
            'more'  => [
                'title' => 'Hepsini Göreyim',
                'url'   => $this->urls['products'],
            ],
        ];

        //$view = hbs('content/product-list', ]);

        
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

        $data['billboard'] = [
            'url' => $this->urls['products'],
            'image' => $image, 
        ];

        //$billboardView = hbs('part/billboard', );

        $this->meta['title'] = 'Merhaba';

        $data['videos'] = [
            'url' => $this->urls['videos'],
        ];

        $view = hbs('content/home', $data);

        return $this->layout($view);
    }

    public function contact()
    {
        $view = hbs('content/iletisim');
        return $this->layout($view);
    }

    public function servisler()
    {
        $servisler = require CUSTOMER_PATH . '/storage/' . 'servisler.php';
        $view = hbs('content/servisler', $servisler);

        return $this->layout($view);

    }

    public function videos()
    {
        $vimeo = file_get_contents(CUSTOMER_PATH.'/storage/vimeo-modified.json');
        $vimeo = json_decode($vimeo, TRUE);

        $view = hbs('content/pure-fix-tv', $vimeo);

        return $this->layout($view);
    }
    
}
