<?php
 

///verifica se o ususario esta logado 
  if(!isset($_SESSION["usuarioId"])){


    $_SESSION["mensagem"] = "Acesso negado!!"; 

    //header("location: ../index.php");

  }

  require("../../database/conexao.php");

  $sql = "SELECT * FROM tbl_categoria";

  $resultado = mysqli_query($conexao, $sql);

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../styles-global.css" />
  <link rel="stylesheet" href="novo.css" />
  <title>Administrar Produtos</title>
</head>
<?php
  include("../../componentes/header/header.php");
  ?>
<body>
  <div class="content">
    <section class="produtos-container">
      <main>
        <form class="form-produto" method="POST" action="acoes.php" enctype="multipart/form-data">
          <h1>Cadastro de produto</h1>
          <ul>
          <?php
            //Verifica se existe erro na sessão do usúario
            if(isset($_SESSION["erros"])){
              //Se existe erro lista ele
              foreach($_SESSION["erros"] as $erro){
          ?>
                <li><?= $erro ?></li>
          <?php      
              }
              //eliminar os erros já mostratos
              unset($_SESSION["erros"]);
            }
          ?>
          </ul>

          <div class="input-group span2">
            <label for="descricao">Descrição</label>
            <input type="text" id="descricao" name="descricao" require>
          </div>
          <div class="input-group">
            <label for="peso">Peso</label>
            <input type="number" min="0" id="peso" name="peso" require>
          </div>
          <div class="input-group">
            <label for="quantidade">Quantidade</label>
            <input type="number" min="0" id="quantidade" name="quantidade" require>
          </div>
          <div class="input-group">
            <label for="cor">Cor</label>
            <input type="text" id="cor" name="cor" require>
          </div>
          <div class="input-group">
            <label for="tamanho">Tamanho</label>
            <input type="text" id="tamanho" name="tamanho">
          </div>
          <div class="input-group">
            <label for="valor">Valor</label>
            <input type="number" min="0" id="valor" name="valor" require>
          </div>
          <div class="input-group">
            <label for="desconto">Desconto</label>
            <input type="number" min="0" id="desconto" name="desconto">
          </div>

          <div class="input-group">
            <label for="categoria">Categorias</label>
            <select type="number" min="0" id="categoria" name="categoria"> 
            
            <option value="">SELECCIONE</option>

            <?php 
            while ($categoria = mysqli_fetch_array($resultado)){
            ?>
                 <option value="<?= $categoria["id"] ?>"><?= $categoria["descricao"] ?></option>
            <?php 
            }
            ?>
           
            </select>
          </div>
          <div class="input-group">
            <label for="foto">Foto</label>
            <input type="file"  id="foto" name="foto">
          </div>
          <input type="hidden" name="acao" value="inserir" accept="image/*"/>
          <button type="button"  onclick="javascript: window.location.href = '../novo'">Cancelar</button>
          <button>Adicionar</button>
        </form>
      </main>
    </section>
  </div>
  <footer>
    SENAI 2021 - Todos os direitos reservados
  </footer>
</body>

</html>