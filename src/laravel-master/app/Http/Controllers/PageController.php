<?php

namespace App\Http\Controllers;

class PageController extends Controller {

    protected $layout = 'layout/test';

    public function __construct()
    {
        parent::__construct();
        $this->meta['titlePrefix'] = 'Sayfa: ';
    }

    public function getTest()
    {
        $this->meta['title'] = 'TEST';
        return $this->createResponse('content/lorem', []);
    }
}
