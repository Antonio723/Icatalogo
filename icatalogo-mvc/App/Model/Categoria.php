<?php

use App\Core\Model;

class Categoria{
    public $id;
    public $descricao;

    public function listarTodas(){
        $sql = "SELECT * from tbl_categoria";
        $stmt = Model::getConexao() -> prepare($sql);
        $stmt->execute();

        if($stmt -> rowCount() >0){
            $resultado = $stmt -> fetchAll(PDO::FETCH_OBJ);
            return $resultado;
        }else{
            return [];
        }
    }

    public function inserir(){
        $sql = "INSERT INTO tbl_categoria (descricao) values(?)";

        $stmt = MODEL::getConexao()->prepare($sql);
        $stmt->bindValue(1, $this->descricao);
        //$stmt->bindValue(2, $this->outrocampo);
        if($stmt->execute()){
            //se der certo, atribuir o id inserido a instacia desta classe
            $this->id = Model::getConexao()->lastInsertId();
            return $this;
        }else{
            return false;
        }
    }
}