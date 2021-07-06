<?php

use App\Core\Model;

class Produto{
    public $id;
    public $descricao;
    public $peso;
    public $tamanho;
    public $quantidade;
    public $cor;
    public $vaor;
    public $desconto;
    public $imagem;

    public function listarTodos(){
        $sql = "SELECT p.*, c.descricao as categoria FROM tbl_produto p INNER JOIN  tbl_categoria c ON p.categoria_id = c.id ORDER BY p.id DESC";
        $stmt = Model::getConexao() -> prepare($sql);
        $stmt->execute();

        if($stmt -> rowCount() >0){
            $resultado = $stmt -> fetchAll(\PDO::FETCH_OBJ);
            return $resultado;
        }else{
            return [];
        }
    }

    public function bucarporid($id){
        $sql = "SELECT p.*, c.descricao as categoria 
                  FROM tbl_produto p 
                 INNER JOIN  tbl_categoria c 
                    ON p.categoria_id = c.id 
                 where p.id = ?";
        $stmt = Model::getConexao() -> prepare($sql);
        $stmt->bindValue(1,$id);
        $stmt->execute();

        if($stmt -> rowCount() >0){
            $resultado = $stmt -> fetchAll(\PDO::FETCH_OBJ);
            return $resultado;
        }else{
            return [];
        }
    }


}