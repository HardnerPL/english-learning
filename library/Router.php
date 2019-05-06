<?php

class Router
{
    private $defaultController;
    private $defaultAction;

    public function __construct($defaultController, $defaultAction, $requireController = true, $offset = 1)
    {
        $this->defaultController = $defaultController;
        $this->defaultAction = $defaultAction;

        $url = explode("/", $_SERVER['REQUEST_URI']);
        $url = array_values(array_filter($url));

        if ($requireController) {
            if (sizeof($url) >= 2 + $offset) {
                $controller = $url[$offset];
                $action = $url[1 + $offset];
                if (sizeof($url) > 2 + $offset) {
                    $params = explode("-", $url[2]);
                } else {
                    $params = array();
                }
                $this->route($controller, $action, $params);
            } else {
                $this->route($defaultController, $defaultAction, array());
            }
        } else {
            if (sizeof($url) >= 1 + $offset) {
                $action = $url[$offset];
                if (sizeof($url) > 1 + $offset) {
                    $params = explode("-", $url[1]);
                } else {
                    $params = array();
                }
                $this->route($defaultController, $action, $params);
            } else {
                $this->route($defaultController, $defaultAction, array());
            }
        }
    }

    private function route($controller, $action, $params) {
        if (file_exists("controller/$controller.php")) {
            require_once "controller/$controller.php";
            $controller = new $controller;
            if (method_exists($controller, $action)) {
                $controller->{$action}($params);
            } else {
                $this->notFound();
            }
        } else {
            $this->notFound();
        }
    }

    private function notFound() {
        require_once "controller/$this->defaultController.php";
        $controller = new $this->defaultController;
        $action = $this->defaultAction;
        $controller->{$action}();
    }
}

