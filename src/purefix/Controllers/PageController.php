<?php

namespace Purefix\Controllers;

use Cart;

class PageController extends Controller {

    protected $layout = 'layout/test';

    public function __construct()
    {
        parent::__construct();
    }

    public function getIndex()
    {
        $hb = $this->hb;
        return $hb('layout/index', []);
    }
    
}
