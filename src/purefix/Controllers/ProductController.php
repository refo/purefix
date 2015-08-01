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
        $grouped = Product::getGroupedByCollection()->toArray();

        return $this->layout(hbs('content/product-list-grouped', $grouped));
    }

    public function detail($slug)
    {
        $product = Product::with('variants')->where('slug', $slug)->first();
        $product->url = route('product', $product->slug);

        $view = hbs('content/product-detail', $product->toArray());

        return $this->layout($view);
    }


}

