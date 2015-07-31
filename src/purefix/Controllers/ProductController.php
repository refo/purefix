<?php

namespace Purefix\Controllers;

use Purefix\Models\Product;
use Purefix\Models\ProductVariant;

class ProductController extends Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function all()
    {
        $products = Product::all();
        $products->map(function($item){
            $item->url = route('product', $item->slug);
            return $item;
        });

        $view = hbs('content/product-list', [
            'title' => 'Bisikletler',
            'list'  => $products->toArray(),
        ]);

        return $this->layout($view);
    }

    public function detail($slug)
    {
        $product = Product::with('variants')->where('slug', $slug)->first();
        $product->url = route('product', $product->slug);

        $view = hbs('content/product-detail', $product);

        return $this->layout($view);
    }


}

