<?php
require("../database/conexao.php");

function validarCampos(){

  $erro = [];
  if(!isset($_POST["descricao"])  || $_POST["descricao"] == ""){
    $erro[] = "campo invalido";
  }
  return $erro;
}

switch($_POST["acao"]){

        case "inserir":

          $erro = validarCampos();

          if(count($erro) > 0){
            $_SESSION["mensagem"] = $erro[0];

            header("location: index.php");

            exit();
          }

          if(isset($_POST["descricao"])){

            $descricao = $_POST["descricao"];
            echo " $descricao";
            echo "<br>";

            $sql = "INSERT INTO  tbl_categoria (descricao) VALUES ('$descricao')";

            $resultado = mysqli_query($conexao, $sql) or die(mysqli_error($conexao));

            if($resultado){
                $_SESSION["mensagem"] = "categoria incluida com sucesso";
            }else{
                $_SESSION["mensagem"] = "Ops, erro ao incluir a cate";
            }

            header("location: index.php");
          }

        break;

        case "deletar":

          $categoriaId = $_POST["categoriaId"];

          $sql = "DELETE FROM tbl_categoria WHERE  id = '$categoriaId'";

          $resultado = mysqli_query($conexao, $sql);

          header("location: index.php");

        break;
}