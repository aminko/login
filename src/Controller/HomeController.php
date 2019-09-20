<?php

namespace Demo\Controller;

use Demo\Base\Controller;

class HomeController extends Controller {
    // TODO: extend with router class
    public function index()
    {
        $title = 'Minko';

        echo $this->view->render('home.twig', ['title' => $title]);
    }

}