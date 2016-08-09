<?php

class App
{

    public function __construct()
    {
        $url = $this->parseUrl();

        $controllerName = "{$url[0]}Controller";

        //如果導入為首頁，則自動導向HameController

        if (!$url) {
            $controllerName = "HomeController";
        }

        if (!file_exists("controllers/$controllerName.php")) {
            return;
        }

        require_once "controllers/$controllerName.php";
        $controller = new $controllerName;
        $methodName = isset($url[1]) ? $url[1] : "index";

        if (!method_exists($controller, $methodName)) {
            return;
        }

        unset($url[0]); unset($url[1]);

        if ($params = $url) {
            array_values($url);
        } else {
            [];
        }
        call_user_func_array([$controller, $methodName], $params);
    }

    public function parseUrl() {
        if (isset($_GET["url"])) {
            $url = rtrim($_GET["url"], "/");
            $url = explode("/", $url);

            return $url;
        }
    }
}
