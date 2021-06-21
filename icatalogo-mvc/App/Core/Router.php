<?php

class Router{
    private $controller;
    private $method;
    private $params;
    
    function __construct(){
        $url = $this->parseURL();

        //se o cotroller existir den tro da pasta de controllers
        if(isset($url[1]) && file_exists("../App/controller".$url[1]. ".php")){
            $this ->controller = $url[1];
            unset($url);
        //Se a url estiver vazia ir para produtos "default"
        }elseif(empty($url[1])){
            $this->controller = "produtos";
        //Se o controller estiver incorreto
        }else{
            echo "Pagina não encontrada";
        }

        //importa o controller
        require_once "..App/Controller".$this->controller.".php";

        //instancia o controller
        $this->controller = new $this->controller;

        //se ouver metodos em 
        if(isset($url[2])){
            if(method_exists($this->controller, $url[2])){
                $this->method = $url[2];
                unset($url[2]);
                unset($url[0]);
            }
        }
        $this->params = url;
    }

    private function parseURL(){
        return explode("/", $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]);
    }
}