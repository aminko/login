<?php

namespace Demo\Controller;

use Demo\Base\Controller;

class HomeController extends Controller {
    // TODO: extend with router class
    public function index($request)
    {
        $title = '';

        if(isset($request->title)){
            $title = $request->title;
        }

        echo $this->view->render('home.twig', ['title' => $title]);
    }

}