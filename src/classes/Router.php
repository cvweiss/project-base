<?php

namespace Project\Base;

class Router
{
    public function route($view)
    {
        $uri = $_SERVER['REQUEST_URI'];
        $method = ucfirst(strtolower($_SERVER['REQUEST_METHOD']));
        $call = "do$method";
        $args = [];

        $ex = explode('?', $uri);
        $uri = $ex[0];
        if ($uri == '/') $uri = 'index';

        $ex = explode('/', $uri);
        foreach ($ex as $key=>$value) if ($ex[$key] == '') unset($ex[$key]);
        while (sizeof($ex) > 0)
        {
            $className = '\\Project\\Base\\Controller\\' . implode('\\', $ex);
            $this->routeCall($className, $call, $view, $args);
            array_unshift($args, array_pop($ex));
        }

        Logger::debug("404 $uri");
        $view->error(404, "$uri could not be found");
    }

    protected function routeCall($className, $call, $view, $args)
    {
        if (class_exists($className))
        {   
            Logger::debug("200 $className $call");
            $className::$call($view, $args);
            exit();
        }
    }
}
