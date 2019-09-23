<?php

namespace Demo\Controller;

use Demo\Base\Controller;

class HomeController extends Controller {
    // TODO: extend with router class
    public function index()
    {
           
        $email = $this->auth->getEmail();
        $baseUrl = $this->config['app']['base_url'];
        return $this->view->render('home.twig', ['email' => $email, 'base_url' => $baseUrl]);
    }

}