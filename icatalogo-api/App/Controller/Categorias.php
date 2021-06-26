<?php

use App\Core\Controller;

class Categorias extends Controller{

    public function index(){
        $categoriaModel = $this -> model("Categoria");
        $categorias = $categoriaModel ->listarTodas();
        $this->view("categorias/index",$categorias);
    }

    public function create(){
        $this -> view("categofria/create");
    }

    public function store(){

        $erros = $this->validarCampos();

        if(count($erros) > 0 ){
            $_SESSION["mensagem"] = $erros[0];
            header("location: /categorias/create");

            exit();
        }

        //instanciamos uma categoria model
        $categoriaModel = $this -> model("Categoria");
        //atribuimos a ela a descricao a ser iserida
        $categoriaModel ->descricao = $_POST["descricao"];

        //chamamos o metodo de inserir que retorna a classe alterada a com o id inserido
        $categoriaModel = $categoriaModel->inserir();

        //deu certo a inserção?
        if($categoriaModel){
            $_SESSION["mensagem"] = "Categoria cadastrada com sucesso";
        }else{
            $_SESSION["mensagem"] = "Problemas ao cadastrar a categoria";
        }

        //redirecionamento para index
        header("location: /categorias");
    
    }

    private function validarCampos(){

        $erro = [];
        if(!isset($_POST["descricao"])  || $_POST["descricao"] == ""){
          $erro[] = "campo invalido";
        }
        return $erro;
    }
}


