<?php

    require("../vendor/autoload.php");
    use App\Model\Produto;

    $produto = new Produto();
    echo $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];

    $produto -> listarTodos();

   $lista = $produto -> listarTodos();

    foreach($lista as $produto){
        echo $produto -> descricao."</br>"; 
    }