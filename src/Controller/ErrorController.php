<?php

namespace Demo\Controller;

use Demo\Base\Controller;

class ErrorController extends Controller
{
    public function notFound()
    {
       return $this->view->render('error404.twig', []);
    }
}