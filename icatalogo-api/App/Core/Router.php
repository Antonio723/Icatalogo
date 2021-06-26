<?php

namespace App\Core;

class Router{
    private $controller;
    private $controllerMethod ="index";
    private $httpMethod ="GET";
    private $params;
    
    function __construct(){
        $url = $this->parseURL();

        //se o cotroller existir den tro da pasta de controllers
        if(isset($url[1]) && file_exists("../App/controller/".$url[1]. ".php")){
            $this ->controller = $url[1];
            unset($url[1]);
        //Se a url estiver vazia ir para produtos "default"
        }elseif(empty($url[1])){
            $this->controller = "produtos";
        //Se o controller estiver incorreto
        }else{
            $this->controller = "erro404";
        }

        //importa o controller
        require_once "../App/Controller/".$this->controller.".php";

        //instancia o controller
        $this->controller = new $this->controller;

        //pegando o HTTP Method

        $_SERVER["REQUEST_METHOD"];

        ///pegando o metodo do controller baseando-se no http Method
        switch($this->httpMethod){

            case "GET":
                $this->controllerMethod = "index";
            break;
            
            case "POST":
                $this->controllerMethod = "store";
            break;
            
            case "PUT":
                $this->controllerMethod = "update";
            break;
            
            case "DELETE":
                $this->controllerMethod = "delete";
            break;
            
            default:
                echo "Método não habilitado";
            exit;
            
        }


        //se ouver um metodo na url e ele existir no controller atribuimos ao atributo method
        if(isset($url[2])){
            if(method_exists($this->controller, $url[2])){
                $this->method = $url[2];
                unset($url[2]);
                unset($url[0]);
            }
        }
        //pagamos os parametros da url
        $this->params = $url ? array_values($url) : [];
        
        //executamos ometodo dentro do controller, passando os parametros
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    private function parseURL(){
        return explode("/", $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]);
    }
}