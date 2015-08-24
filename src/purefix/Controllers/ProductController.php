<?php

namespace Purefix\Controllers;

use Purefix\Models\Product;
use Purefix\Models\ProductVariant;

class ProductController extends Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index($collection = NULL)
    {
        if (is_null($collection)) {
            return $this->all();
        }

        $products = Product::getByCollection($collection)->toArray();
        return $this->layout(hbs('content/product-list-grouped', [$products]));
    }

    public function all()
    {
        $grouped = Product::getGroupedByCollection()->toArray();

        return $this->layout(hbs('content/product-list-grouped', $grouped));
    }

    public function detail($slug)
    {
        $product = Product::getDetail($slug);
        // $product = Product::with('variants')->where('slug', $slug)->first();
        // $product->url = route('product', $product->slug);
        
        // Burası, model içinde olmalı
        // 
        list($brand, $collection) = explode('-', strtolower($product->collection), 2);
        
        $product->$brand      = TRUE;
        $product->$collection = TRUE;

        $view = hbs('content/product-detail', $product->toArray());

        return $this->layout($view);
    }

    public function sale()
    {
        $view = hbs('content/firsat.html');
        return $this->layout($view);
    }

    public function search($keyword)
    {
        return Product::with('variants')->where('title', 'like', '%'.$keyword.'%')->get();
    }


}

