<?php

class Router 
{

    public static function route() 
    {
        $url = explode("/", $_SERVER['REQUEST_URI']);
        if (sizeof($url) >= 3) {
            $controller = $url[1];
            $action = $url[2];
            if (sizeof($url) > 3) {
                $data = explode("-", $url[3]);
            } else {
                $data = array();
            }
        }
        require "controller/$controller.php";
        $controller = new $controller;
        $controller->{$action}($data);
    }
}
