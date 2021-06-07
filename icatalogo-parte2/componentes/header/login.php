<?php

session_start();
require("../../database/conexao.php");

$acao = $_POST["acao"];


switch ($acao) {
    case "login":
        password_hash($senha, PASSWORD_DEFAULT);
        $user = $_POST["usuario"];
        $password = $_POST["senha"];

        $query = "select * from tbl_administrador where usuario = '$user'";
        $output = mysqli_query($conexao, $query);

        $usuario = mysqli_fetch_array($output);

        if ( password_verify($password, $usuario["senha"]) and $usuario["usuario"] == $user) {
            $_SESSION["secao"] = true;
        } else {
            $erro = "usuario ou senha inválidos";
        }
        break;

    case "logout":
        $_SESSION["secao"] = false;

}
header("location: ../../produtos/index.php");
