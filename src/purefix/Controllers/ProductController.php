<?php

namespace Purefix\Controllers;

use Purefix\Models\Product;
use Purefix\Models\ProductVariant;

class ProductController extends Controller {

    public function all()
    {
        return Product::with('variants')->get();
    }


}

