<?php

use App\Core\Controller;

class Categorias extends Controller
{

    public function index()
    {
        $categoriaModel = $this->model("Categoria");
        $categorias = $categoriaModel->listarTodas();
        echo json_encode($categorias, JSON_UNESCAPED_UNICODE);
    }

    public function find($id)
    {
        $categoriaModel = $this->model("Categoria");
        $categoria = $categoriaModel->buscarporid($id);
        if ($categoria) {
            echo json_encode($categoria, JSON_UNESCAPED_UNICODE);
        } else {
            http_response_code(400);
            echo json_encode(["erro" => "Categoria não encontrada"], JSON_UNESCAPED_UNICODE);
        }
    }

    public function store()
    {
        //pegando o corpo da reuisicao, que retorna uma string
        $json = file_get_contents("php://input");
        //tranformando o corpo da requisicao em objeto
        $novaCategoria = json_decode($json);

        $categoriaModel = $this->model("Categoria");
        $categoriaModel->descricao = $novaCategoria->descricao;
        $categoriaModel = $categoriaModel->inserir();

        if ($categoriaModel) {
            http_response_code(201);
            echo json_encode($categoriaModel, JSON_UNESCAPED_UNICODE);
        } else {
            http_response_code(500);
            echo json_encode(["erro" => "Erro ao adicionar a categoria"], JSON_UNESCAPED_UNICODE);
        }
    }

    public function update($id)
    {
        $categoriaEditar = $this->getRequestBody();

        //instanciando o model
        $categoriaModel = $this->model("Categoria");
        $categoriaModel = $categoriaModel->buscarPorId($id);
        //verificando se o id existe
        if (!$categoriaModel) {
            http_response_code(404);
            echo json_encode(["erro" => "Categoria não encontrda"]);
            exit();
        }
        //atribuindo a descricao ao model
        $categoriaModel->descricao = $categoriaEditar->descricao;

        //chamando o método atualizar do model
        if ($categoriaModel->atualizar()) {
            http_response_code(204);
        } else {
            http_response_code(500);
            echo json_encode(["erro" => "Problemas ao aditar categoria"]);
        }
    }

    public function delete($id)
    {
        $categoriaModel = $this->model("Categoria");
        $categoriaModel->id = $id;
        
        if (!$categoriaModel->buscarPorId($id)) {
            http_response_code(404);
            echo json_encode(["erro" => "Categoria inesistente"], JSON_UNESCAPED_UNICODE);
            exit;
        }

        if ($categoriaModel->verificarProdutos() > 0) {
            http_response_code(400);
            echo json_encode(["erro" => "A categoria nãofoi excluida, pois tem um produto cadastrado"]);
            exit;
        }

        if ($categoriaModel->deletar()) {
            http_response_code(204);
        } else {
            http_response_code(500);
            echo json_encode(["erro" => "Problemas ao excluir categria"], JSON_UNESCAPED_UNICODE);
        }
    }
}
