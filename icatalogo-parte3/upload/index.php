<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload de arquios</title>
</head>
<body>
    <form method="POST" enctype="multipart/form-data" action="acoes.php">
          <input type="file" name="imagem" accept="image/*">
        <br>
        <br>
         <button>Enviar</button>
    </form>
</body>
</html>






                <?php 
                 while ($listaDacategoria= mysqli_fetch_array($resultado)){
                 ?>
           
                <article class="card-produto">
                    <figure>
                      <img src="fotos/<?php $novoNomeArquivo ?>" />
                    </figure>
                    <section>
                        <span class="preco"><?= $listaDacategoria["valor"] ?></span>
                        <span class="parcelamento">ou em <em>10x R$100,00 sem juros</em></span>

                        <span class="descricao"><?= $listaDacategoria["descricao"] ?></span>
                        <span class="categoria">
                            <em><?= $listaDacategoria["descricao"] ?>
                        </span>
                    </section>
                    <footer>

                    </footer>
                </article>  

                 <?php 
                  }
                 ?>

                    <article class="card-produto">
                    <figure>
                        <img src="../imgs/air.jpg" />
                    </figure>
                    <section>
                        <span class="preco">R$ 1000,00</span>
                        <span class="parcelamento">ou em <em>10x R$100,00 sem juros</em></span>

                        <span class="descricao">Produto xyz cor preta novo perfeito estado 100%</span>
                        <span class="categoria">
                            <em>Calçados</em> <em>Vestuário</em><em>Calçados</em>
                        </span>
                    </section>
                    <footer>

                    </footer>
                </article>  