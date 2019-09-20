<?php

namespace Demo\Controller;

use Demo\Base\Controller;

class TaskController extends Controller
{
    public function show($id)
    {
        echo $id;
    }
}