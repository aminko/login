<?php

namespace Demo\Controller;

use Demo\Base\Controller;

class AuthController extends Controller
{
    public function login()
    {
        // return login view
        echo "Login form";
    }

    public function validate()
    {
        $params = $this->request->post;
        print_r($params);
        echo "Validate request";
    }

    public function register()
    {
        echo 'Registration form';
    }

    public function registration()
    {
        $params = $this->request->post;
        echo "Register user";
    }

}