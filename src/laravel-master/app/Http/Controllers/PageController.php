<?php

namespace App\Http\Controllers;

use Cart;

class PageController extends Controller {

    protected $layout = 'layout/test';

    public function __construct()
    {
        parent::__construct();
        $this->meta['titlePrefix'] = 'Sayfa: ';
    }

    public function getTestCart()
    {

        Cart::add([
            'id' => 'ABC123',
            'name' => 'Juliet',
            'qty' => 1,
            'price' => 329,
            'options' => ['size' => 'Medium - 56cm']
        ]);

        return Cart::content();
    }

    public function getTest()
    {
        $this->meta['title'] = 'TEST';
        return $this->createResponse('content/lorem', []);
    }
}
