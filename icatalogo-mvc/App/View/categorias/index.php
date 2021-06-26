<div class="categorias-container">
    <h1>Lista de categorias</h1>

    <?php
    if (count($dados) == 0) {
        echo " <center> nenhuma categoria cadastrada </center>";
    }
    foreach ($dados as $categoria) {

    ?>
        <div class="card-categorias">
            <?= $categoria->descricao ?>
            <img onclick="deletar(<?= $categoria->id ?>)" src="https://icons.veryicon.com/png/o/construction-tools/coca-design/delete-189.png" />
        </div>
    <?php } ?>
    <form id="form-deletar" method="POST" action="./acoes_categorias.php">

        <input type="hidden" name="acao" value="deletar" />
        <input id="categoria-id" type="hidden" name="categoriaId" value="" />

    </form>
</div>