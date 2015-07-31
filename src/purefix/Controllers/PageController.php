<?php

namespace Purefix\Controllers;

use Cart;

class PageController extends Controller {

    protected $layout = 'layout/default';

    public function __construct()
    {
        parent::__construct();
    }

    public function getIndex()
    {
        $viewData = [
            'partial' => 'test/partial',
        ];
        return hbs('test/layout', $viewData);
    }
    
}
