<?php

namespace Demo\Controller;

use Demo\Base\Controller;

class AppController extends Controller {
    // TODO: extend with router class
    public function show($request)
    {
        $title = '';

        if(isset($request->title)){
            $title = $request->title;
        }

        echo $this->view->render('home.twig', ['title' => $title]);
    }

}