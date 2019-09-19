<?php

namespace Demo\Base;

use Demo\Base\View;

class Controller {

    protected $view;

    public function __construct()
    {
        $this->view = new View();
    }
}