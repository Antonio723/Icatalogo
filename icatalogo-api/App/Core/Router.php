<?php

namespace App\Core;

class Router
{
    private $controller;
    private $httpMethod = "GET";
    private $controllerMethod;
    private $params = [];

    function __construct(){

        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
        header("Access-Control-Allow-Headers: Content-Type");
        //setar no header doresponse o content-type
        header("content-type: application/json");
        
        //recuperand url acessada
        $url = $this->parseURL();

        //se o cotroller existir den tro da pasta de controllers
        if (isset($url[1]) && file_exists("../App/controller/" . $url[1] . ".php")) {
            $this->controller = $url[1];
            unset($url[1]);
            //Se a url estiver vazia ir para produtos "default"
        } elseif (empty($url[1])) {
            $this->controller = "produtos";
            //Se o controller estiver incorreto
        } else {
            $this->controller = "erro404";
        }

        //importa o controller
        require_once "../App/Controller/" . $this->controller . ".php";

        //instancia o controller
        $this->controller = new $this->controller;

        //pegando o HTTP Method
        $this->httpMethod = $_SERVER["REQUEST_METHOD"];

        ///pegando o metodo do controller baseando-se no http Method
        switch ($this->httpMethod) {

            case "GET":
                if (!isset($url[2])) {
                    $this->controllerMethod = "index";
                } elseif (is_numeric($url[2])) {
                    $this->controllerMethod = "find";
                    $this->params = [$url[2]];
                } else {
                    http_response_code(400);
                    echo json_encode(["erro" => "Parametro Invalido"], JSON_UNESCAPED_UNICODE);
                    exit;
                }

                break;

            case "POST":
                $this->controllerMethod = "store";
                break;

            case "PUT":
                $this->controllerMethod = "update";
                $this->getParams($url);
                break;
                
            case "DELETE":
                $this->controllerMethod = "delete";
                $this->getParams($url);
                
                break;

            default:
                echo "Método não habilitado";
                exit;
            }
            //executamos o metodo dentro do controller, passando os parametros
            call_user_func_array([$this->controller, $this->controllerMethod], $this->params);
        }
        
        private function parseURL()
    {
        return explode("/", $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]);
    }
    
    private function getParams($url){
        if (!isset($url[2])) {
            http_response_code(400);
            echo json_encode(["erro" => "Parametro não informado"], JSON_UNESCAPED_UNICODE);
            exit;
        } elseif (is_numeric($url[2])) {
            $this->params = [$url[2]];
        } else {
            http_response_code(400);
            echo json_encode(["erro" => "Parametro Invalido"], JSON_UNESCAPED_UNICODE);
            exit;
        }

    }

}
