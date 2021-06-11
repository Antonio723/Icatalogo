<?php
require("../../database/conexao.php");
session_start();

$acao = isset($_REQUEST["acao"])?$_REQUEST["acao"]:"erro";

function validarCampos(){
    $erros=[];
if(isset($_POST["usuario"]) || $_POST["usuario"] == ""){
    $erros[] = "o campo usuario é obrigatorio ";
}
if(isset($_POST["senha"]) || $_POST["senha"] == ""){
    $erros[] = "o campo senha é obrigatorio ";
}
return $erros;
}
switch ($acao) {
    case "login":
        
        $erros= validarCampos();

        if(count($erros) >0){
            $_SESSION["erros"] = $erros;

        }
//implementar hoje

        //receber os campos usuário e senha do post

        //$usuario = $_GET["usuario"];
        $usuario = isset($_POST["usuario"])?$_POST["usuario"]:"erro";
        $senha = isset($_POST["senha"])?$_POST["senha"]:"erro";
 
        //SELECT * FROM tbl_administrador WHERE usuario = $usuario;
         $sql = "SELECT * FROM tbl_administrador WHERE usuario = '$usuario'";
         //executar o sql
         $resultado =  mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
 
         $dados = mysqli_fetch_array($resultado);

         $usuarios = $dados["usuario"];
         $senhas = $dados["senha"];

         //resultado se o usuário existe
        // if ($usuarios == $usuario && $senhas == $senha){
 
          //  $_SESSION["usuarioId"] = $dados["id"];
          //  $_SESSION["usuarioNome"] = $dados["nome"];

          //  $mensagem = "usuario e senha corretos <br>";
             
       //  }else{
          //   $erros[] = "usuario ou senha invalido";
         //} 
         if (!$dados || !password_verify($senha, $dados["senha"])){
 
           

            $mensagem = "usuario ou senha invalido";
             
         }else{
             $_SESSION["usuarioId"] = $dados["id"];
             $_SESSION["usuarioNome"] = $dados["nome"];
             
         }               
         //verificar se a senha está correta
        
         //se estiver correta, salvar o id e o nome do usuário na sessão $_SESSION
         //se a senha estiver errada, criar uma mensagem de "usuário e/ou senha inválidos"
         //redirecionar para a tela de listagem de produtos
         header("location: ../../produtos/index.php ");
    
        break;
    case "logout":
        //implementar futuramente
        //destruir a secao
        session_destroy();
        //redirecionar para index de produtos 
        header("location: ../../produtos/index.php ");

        break;
}
 