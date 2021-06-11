<?php
require("../../database/conexao.php");

session_start();

// Função para a validação dos campos
function validacaoCampos (){
    $erros = [];
    
    if(!isset($_POST["descricao"]) && $_POST["descricao"] == ""){
        $erros[] = "O campo descrição é obrigatorio";
    }

    if(!isset($_POST["peso"]) && $_POST["peso"] == ""){
        $erros[] = "O campo peso é obrigatorio";
    }elseif(!is_numeric(str_replace(",", ".", $_POST["peso"]))){
        $erros[] = "O campo peso deve ser um número";
    } 

    if(!isset($_POST["quantidade"]) && $_POST["quantidade"] == ""){
        $erros[] = "O campo quantidade é obrigatorio";
    }elseif(!is_numeric(str_replace(",", ".", $_POST["quantidade"]))){
        $erros[] = "O campo quantidade deve ser um número";
    } 

    if(!isset($_POST["cor"]) && $_POST["cor"] == ""){
        $erros[] = "O campo cor é obrigatorio";
    }

    if(!isset($_POST["valor"]) && $_POST["valor"]==""){
        $erros[] = "O campo valor é obrigatorio";
    }elseif(!is_numeric(str_replace(",", ".", $_POST["valor"]))){
        $erros[] = "O campo valor deve ser um número";
    }

    if(isset($_POST["desconto"]) && $_POST["desconto"] != ""){
        if(!is_numeric(str_replace(",", ".", $_POST["valor"]))){
            $erros[] = "O campo desconto deve ser um número";
        }
    }
    if($_FILES["foto"]["error"] == UPLOAD_ERR_NO_FILE){
        $erros[] = "o campo foto ie obrigatorio";
    }elseif($_FILES["foto"]["error"] != UPLOAD_ERR_OK){
        $erros[] = "ops, houve um erro com o upload";
    }else{
        //pega as informacoes da imagem
        $imagemInfo = getimagesize($_FILES["foto"]["tmp_name"]);

        if(!$imagemInfo){
            $erros[] = " O aruivo deve ser uma imagem";
        }elseif($_FILES["foto"]["size"] > 1024 * 1024 *2){
            $erros[] = "A foto nao pode ser maior que 2MB";
        }

        // verifica se a imagem é quadrada
        $width = $imagemInfo[0];
        $heigth = $imagemInfo[1];

        if($width != $heigth){
            $erros[] = "A imagem tem q ser quadrada";
        }
    }
    if(!isset($_POST["categoria"]) && $_POST["categoria"]==""){
        $erros[] = "O campo categoria é obrigatorio";
    }
    return $erros;
}


switch ($_POST["acao"]) {

    case "inserir":

        $erros = validacaoCampos();


        if(count($erros) > 0){
            $_SESSION["erros"] = $erros;

            header("location: index.php ");
            exit();
        }
           
            $novoArquivo = $_FILES["foto"]["name"];

            $extensao  = pathinfo($novoArquivo, PATHINFO_EXTENSION);

            $novoNomeArquivo = md5(microtime()).".$extensao";

            move_uploaded_file($_FILES["foto"]["tmp_name"], "../fotos/$novoNomeArquivo");

            $categoria = $_POST["categoria"];

            $descricao = $_POST["descricao"];
            // Trocando a virgula por ponto
            $peso = str_replace(",", ".", $_POST["peso"]);
            $quantidade = $_POST["quantidade"];
            $cor = $_POST["cor"];
            // Trocando a virgula por ponto
            $valor = str_replace(",", ".", $_POST["valor"]);
            $tamanho = $_POST["tamanho"];
            $desconto = $_POST["desconto"] != "" ? $_POST["desconto"] : 0;
        
            $sqlinsert= "INSERT INTO tbl_produto (descricao, peso, quantidade, cor, tamanho, valor, desconto, imagem, categoria_id)
                            VALUES ('$descricao', $peso, $quantidade, '$cor', '$tamanho', $valor, $desconto, '$novoNomeArquivo', '$categoria')";
            
            $resultado = mysqli_query($conexao, $sqlinsert) or die(mysqli_error($conexao)); 
            
           
          
            
           header("location: ../index.php");
        
        // $_SESSION["location: index.php"];
        break;
        case "deletar":

            $categoriaId = $_POST["categoriaId"];
          
          
            $sql = "DELETE FROM tbl_produto WHERE  id = '$categoriaId'";
  
            $resultado = mysqli_query($conexao, $sql);
  
            header("location: ../index.php");
  
          break;
       
}