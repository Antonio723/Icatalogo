<?php session_start(); 


require("../database/conexao.php");


if(isset($_GET["pesquisa"])&&$_GET["pesquisa"] != ""){
    $pesquisaDoUsuario = $_GET["pesquisa"]? $_GET["pesquisa"]:"" ;

    $sql ="SELECT p.*, c.descricao as categoria FROM tbl_produto p
    INNER JOIN tbl_categoria c ON p.categoria_id = c.id
    WHERE p.descricao LIKE '$pesquisaDoUsuario'
    OR c.descricao LIKE '$pesquisaDoUsuario'
    ORDER BY p.id DESC";
?>
            
<?php }else{

    $sql = "SELECT p.*, c.descricao as categoria FROM tbl_produto p
    INNER JOIN tbl_categoria c ON p.categoria_id = c.id
    ORDER BY p.id DESC";
}

$resultado = mysqli_query($conexao, $sql) or die(mysqli_error($conexao));

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles-global.css" />
    <link rel="stylesheet" href="./produtos.css" />
    <title>Administrar Produtos</title>
</head>

<?php
  include("../componentes/header/header.php");

?>

<!--<header>
        <input type="search" placeholder="Pesquisar" />
</header>-->
<body>
   
    <div class="content">
        <section class="produtos-container">
        <?php 
               if(isset($_SESSION["usuarioId"])   ){
        ?>
            <header>
                <button onclick="javascript:window.location.href ='./novo'">Novo Produto</button>
                <button  onclick="javascript:window.location.href ='../categorias'">Nova Categoria </button>
            </header>
        <?php
            }
        ?>
            <main>


                 <?php 
                 while ($listaDacategoria= mysqli_fetch_array($resultado)){

                    if($listaDacategoria["desconto"] > 0){
                        //tranformou a porcentagem em decimal
                        $desconto = $listaDacategoria["desconto"] / 100;
                        //calculou o valor com desconto e aplicou no valor do produto
                        $valor = $listaDacategoria["valor"] - $desconto * $listaDacategoria["valor"];
                      }else{
                        //se não tiver desconto, o valor recebe o preço cheio
                        $valor = $listaDacategoria["valor"];
                      }
                     $qntDadedeParcelas = $listaDacategoria["valor"] > 1000 ? 12: 6;
                     $valorParcela = $listaDacategoria["valor"] / $qntDadedeParcelas;
                     //formatamos o valor da parcela
                     $valorParcela = number_format($valorParcela, 2,",",".");
                 ?>
           
                <article class="card-produto">
                    <figure>
                        <img src="../produtos/fotos/<?= $listaDacategoria["imagem"] ?>" />
                    </figure>
                    <section>
                        <span class="preco">R$ <?= number_format($valor, 2,",",".") ?>

                        <?php if($listaDacategoria["desconto"] > 0){ ?>
                        <em>
                            <?= $listaDacategoria["desconto"]?> %off
                        </em>
                        <?php } ?>
                        </span>

                        <span class="parcelamento">ou em <em> <?= $qntDadedeParcelas?> R$<?= $valorParcela ?> sem juros</em></span>

                        <span class="descricao"><?= $listaDacategoria["descricao"] ?></span>
                        <span class="categoria">

                            <em><?= $listaDacategoria["descricao"] ?></em> 
                            <?php 
                                if(isset($_SESSION["usuarioId"])   ){
                            ?>
                            <img class="imagem-produto" onclick="deletar(<?= $listaDacategoria['id'] ?>)" src="https://icons.veryicon.com/png/o/construction-tools/coca-design/delete-189.png" />
                            <?php 
                                }
                            ?>
                        </span>
                    </section>
                    <footer>

                    </footer>

                    <form id="form-deletar" method="POST" action="./novo/acoes.php">
                        <input type="hidden" name="acao" value="deletar"/>
                        <input id="categoria-id" type="hidden" name="categoriaId" value=""/>
                    </form>

                </article>  

                  <?php } ?>
                
            </main>
        </section>
    </div>
    <footer>
        SENAI 2021 - Todos os direitos reservados
    </footer>
    <script lang="javascript"> 
    
    function deletar(categoriaId){
        document.querySelector("#categoria-id").value = categoriaId;

        document.querySelector("#form-deletar").submit();
                                }
    </script>
</body>

</html>