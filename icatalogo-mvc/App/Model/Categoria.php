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
    
    public function edit(){
        $sql = "SELECT * FROM tbl_categoria where id = ?";
        $stmt = MODEL::getConexao()->prepare($sql);
        $stmt->bindValue(1, $this->id);
        $stmt->execute();

        if($stmt->rowCount()>0){
            $categoria = $stmt->fetch(PDO::FETCH_OBJ);

            $this-> id = $categoria->id;
            $this-> descricao = $categoria->descricao;
            return $this;
        }else{
            return false;
        }
    }

    public function buscarPorId($id)
    {

        $sql = " SELECT * FROM tbl_categoria WHERE id = ? ";

        $stmt = Model::getConexao()->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $categoria = $stmt->fetch(PDO::FETCH_OBJ);

            $this->id = $categoria->id;
            $this->descricao = $categoria->descricao;
            return $this;
        } else {
            return false;
        }
    }

    public function atualizar(){
        $sql = "UPDATE tbl_categoria SET descricao = ? WHERE id = ?";

        $stmt = Model::getConexao()->prepare($sql);
        $stmt->bindParam(1, $this->descricao);
        $stmt->bindParam(2, $this->id);
        return $stmt->execute();
    }

    public function deletar(){
        $sql = "DELETE FROM tbl_categoria where id=?";
        $stmt = Model::getConexao()->prepare($sql);
        $stmt->bindValue(1, $this->id);

        return $stmt->execute();
    }
    
}