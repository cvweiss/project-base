<?php

namespace Project\Base\Controller;

class index
{
    function doGet($app, $jade, $view, $values)
    {
        $content = ['content' => 'Hello World!', 'title' => 'Home Page'];

        $view->render("index", $content);
    }
}