<?php
session_start();

require("../../database/conexao.php");


function ValidarCampos()
{
    $mensagem = [];

    if (!isset($_POST['descricao']) && $_POST['descricao'] == "") {
        $mensagem['descricao'] = "O campo descrição deve ser preenchido";
    }

    if (!isset($_POST["peso"]) && $_POST["peso"] == "") {
        $mensagem['peso'] = "O campo descrição deve ser preenchido";
    } elseif (!is_numeric(str_replace(",", ".", $_POST["peso"]))) {
        $mensagem['peso']= "O campo deve ser um número";
    }

    if (!isset($_POST["quantidade"]) && $_POST["quantidade"] == "") {
        $mensagem['quantidade'] = "O campo descrição deve ser preenchido";
    }elseif(!is_numeric($_POST["quantidade"])){
        $mensagem['quantidade'] = "O campo quantidade deve ser numerico";
    }

    if (!isset($_POST["cor"]) && $_POST["cor"] == "") {
        $mensagem['cor'] = "O campo descrição deve ser preenchido";
    }

    if (!isset($_POST["valor"]) && $_POST["valor"] == "") {
        $mensagem['valor'] = "O campo tamanho deve ser preenchido";
    } elseif (!is_numeric(str_replace(",", ".", $_POST["valor"]))) {
        $mensagem ['valor']= "O campo deve ser um número, use virgula para numeros decimais";
    }

    return $mensagem;
}

$erros = validarCampos();

if ( $erros > 0) {

    $_SESSION["erros"] = $erros;
    
    header("location: index.php");
}


$descricao = $_POST["descricao"];
$peso = str_replace( ",", ".",$_POST["peso"] );
$quantidade = $_POST["quantidade"];
$cor = $_POST["cor"];
$tamanho = $_POST["tamanho"];
$valor = str_replace( ",", ".",$_POST["valor"] );
$desconto = str_replace(",", ".", $_POST["desconto"]) != "" ? $_POST["desconto"] : 0;


$sqlinsert = "insert into tbl_produto (descricao, peso, quantidade, cor, tamanho, valor, desconto) values ('$descricao', $peso, $quantidade, '$cor', '$tamanho', $valor, $desconto)";


$resultado = mysqli_query($conexao, $sqlinsert);


if ($resultado) {
    echo "inserido com sucesso". "</br>";
} else {
    echo "erro ao inserir dados". "</br>";
}

header("location: index.php");