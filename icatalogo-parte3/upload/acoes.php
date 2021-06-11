<?php


function validarCampos()
{
    $erros = [];
//se nao houver uma arquivo no campo imagem
    if($_FILES["imagem"]["error"] == UPLOAD_ERR_NO_FILE){

        $erros[] = "O CAMPO IMAGEM É OBRIGATORISO";
//se houver erro no upload
    }elseif(!isset($_FILES["imagem"]) || $_FILES["imagem"]["error"] != UPLOAD_ERR_OK){

        $erros[] = " Ops, houve um erro inesperado, verifique o arqrivo e tente novamente";

    }else{
//pegamos as informacoes da imagem
            $imagemInfos = getimagesize($_FILES["imagem"]["tmp_name"]);

//se nao for uma imagem
        if(!$imagemInfos){
            $erros[]  = "O arquivo tem q ser uma imagem";
    }        
//se a imagem for maior que  1MB
        if($_FILES["imagem"]["size"] > 1024 * 1024){
            $erros[] = "O arquivo nao pode ser maior que 1MB";
        }
    }

    return $erros;
}

$erros = validarCampos();

if(count($erros) > 0 ){

    echo $erros[0];

    exit();
}

//ta pegando o nome original do arquivo enviado
$nomeArquivo = $_FILES["imagem"]["name"];

//esta pegando a extencao do arquivo. tipo(png ou jpg)
$extencao = pathinfo($nomeArquivo, PATHINFO_EXTENSION);

//gerando um novo nome unico e colocamos a extencao do arquivo
$novoNomeArquivo = md5(microtime()).".$extencao";

//e aqui ta pegando o arquivo enviado da outra pasta e enviando para a pasta imagens q esta 
//nesse projeto
move_uploaded_file($_FILES["imagem"]["tmp_name"], "./imagens/$novoNomeArquivo");

//para que possamos mostrar ele para os usuário futuramente//da seguinte forma:
    
?>

<img src="./imagens/<?= $novoNomeArquivo ?>" width="200dp" />