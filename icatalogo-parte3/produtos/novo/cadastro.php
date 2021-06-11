<?php

require("../../database/conexaoBD.php");

//      $descricao = $_POST["desconto"];
//     $peso = $_POST["peso"];
//     $quantidade = $_POST["quantidade"];
//     $cor = $_POST["cor"];
//     $valor = $_POST["valor"];


        $sqlinsert= "INSERT INTO tbl_produto (descricao, peso, quantidade, cor, valor) VALUES ('$descricao', $peso, $quantidade, '$cor', $valor)";
        $resultado = mysqli_query($conexao, $sqlinsert);

    if ($resultado == false) {
        echo "deu erro";
    }else{    
        header("location: index.php?mensagem=padrão");
    }
    
    if(isset($_POST["tamanho"])){
        $tamanho = $_POST["tamanho"];
        
        $sqlinsert= "INSERT INTO tbl_produto (descricao, peso, quantidade, cor, valor, tamanho) VALUES ('$descricao', $peso, $quantidade, '$cor', $valor, '$tamanho')";
        $resultado = mysqli_query($conexao, $sqlinsert);
        
        if ($resultado == false) {
            echo "deu erro";
        }else{    
            header("location: index.php?mensagem=comTamanho");
        }
        
    }
    
    if(isset($_POST["desconto"])){
        $desconto = $_POST["desconto"];

        $sqlinsert= "INSERT INTO tbl_produto (descricao, peso, quantidade, cor, valor, tamanho, desconto) VALUES ('$descricao', $peso, $quantidade, '$cor', $valor, '$tamanho', $desconto)";
        $resultado = mysqli_query($conexao, $sqlinsert);
        
        if ($resultado == false) {
            echo "deu erro";
        }else{    
            header("location: index.php?mensagem=comDesconto");
        }
        
    }
    
    // PARA O PESSOAL QUE FOR TERMINANDO A INSERÇÃO:
    
    // CRIAR UMA FUNÇÃO QUE VALIDE O FORMULÁRIO.
    
    // A FUNÇÃO DEVE VALIDAR OS CAMPOS OBRIGATÓRIOS E ACEITAR SOMENTE VALORES NUMÉRICOS PARA OS CAMPOS:
    // quantidade, valor, desconto e peso

    // A FUNÇÃO DEVE RETORNAR UM VETOR CONTENDO OS ERROS DE VALIDAÇÃO, CASO NÃO TENHA ERRO, RETORNAR UM VETOR VAZIO

    function validacao (string $descricao, string $cor, string $tamanho, $peso, $valor, $quantidade, $desconto){
        $erros = [];

        if(isset($_POST["descricao"])){

        }
        if(isset($_POST["peso"])){
    
        }
        if(isset($_POST["quantidade"])){
    
        }
        if(isset($_POST["cor"])){
    
        }
        if(isset($_POST["valor"])){
    
        }
        if(isset($_POST["tamanho"])){
    
        }
        if(isset($_POST["desconto"])){
    
        }
    }