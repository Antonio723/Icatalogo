<?php

use App\Core\Controller;

class Produtos extends Controller{

    public function index(){
        $produtoModel = $this -> model("Produto");
        $dados = $produtoModel ->listarTodos();
        echo json_encode($dados, JSON_UNESCAPED_UNICODE);
    }
}
