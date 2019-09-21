<?php

namespace Demo\Controller;

use Demo\Base\Controller;

class ErrorController extends Controller
{
    public function notFound()
    {
        if(!$this->auth->isLoggedIn())
        header('Location: /login', true, 301);
        exit;

        return $this->view->render('error404.twig', []);
    }
}