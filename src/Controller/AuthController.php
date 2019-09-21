<?php

namespace Demo\Controller;

use Demo\Base\Controller;

class AuthController extends Controller
{
    public function login()
    {
        // return login view
        return $this->view->render('login.twig', []);
    }

    public function authenticate()
    {
        $params = $this->request->post;
        print_r($params);
        echo "Authentication proccess";
    }


}