<?php

namespace controller;
use dao\TreinoDAO;
use Exception;
use model\Treino;

class TreinoController
{
    public function novo()
    {
        $treino = null;
        $erro = $_SESSION['erro_cadastro'] ?? null;
        unset($_SESSION['erro_cadastro']);
        $dadosDashboard = TecnicoController::getDadosDashboard();
        require __DIR__ . "/../view/cadastro-treino.php";
    }

    public function cadastrar()
    {
        try {
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
            $focoTatico = filter_input(INPUT_POST, 'esquema_tatico', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $intensidade = filter_input(INPUT_POST, 'instrucoes_gerais', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $clima = filter_input(INPUT_POST, 'instrucoes_gerais', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $treino = $id ? TreinoDAO::buscarId($id) : new Treino();
            if(empty($cliente))
                throw new Exception("Treino não encontrado.");
            $treino->setFocoTatico($focoTatico);
            $treino->setIntensidade($intensidade);
            $treino->setClima($clima);
            $treino->setDescricao($descricao);

            TreinoDAO::salvar($treino);
            AtividadeHelper::registrarAtividade("Treino criado/atualizado", 'treino');
            header('Location:' . BASE_URL . '/treinos');
        } catch (Exception $e) {
            echo 'Falha ao salvar a Treino.' . $e->getMessage();
            header('Location:' . BASE_URL . '/treinos/novo');
        } finally {
            exit;
        }
    }
     public function editar(array $params)
    {
        try {
            $id = $params['id'];
            $treino = TreinoDAO::buscarId($id);
            if (empty($treino)) {
                throw new Exception("Treino não encontrado");
            }
            $erro = null;
        } catch (Exception $ex) {
            $treino = null;
            $erro = "Falha ao buscar treino: " . $ex->getMessage();
        }
        $dadosDashboard = TecnicoController::getDadosDashboard();
        require __DIR__ . "/../view/cadastro-treino.php";
    }
    public function listar()
    {
        $treinos = [];
        try {
            $treinos = TreinoDAO::listar();
        } catch (Exception $ex) {
            echo "Falha ao listar as treinos" . $ex->getMessage();
        }
        $dadosDashboard = TecnicoController::getDadosDashboard();
        require __DIR__ . "/../view/lista-treinos.php";
    }

    public function buscar(array $params)
    {
        try {
            $id = $params['id'];
            $treino = TreinoDAO::buscarId($id);
            if (empty($treino)) {
                throw new Exception("Treino não encontrado");
            }
            $erro = null;
        } catch (Exception $ex) {
            $treino = null;
            $erro = "Falha ao buscar treino: " . $ex->getMessage();
        }
        require __DIR__ . "/../view/visualizar-treino.php";
    }

    public function remover(array $params)
    {
        try {
            $id = $params['id'];
            $treino = TreinoDAO::buscarId($id);
            if (empty($treino)) {
                throw new Exception("Treino não encontrado");
            }
            TreinoDAO::deletar($treino);
            $_SESSION['sucesso'] = 'Treino removido com sucesso!';
        } catch (Exception $e) {
            $_SESSION['erro'] = 'Falha ao remover treino: ' . $e->getMessage();
        }
        header('Location: ' . BASE_URL . '/treinos');
        exit;
    }
}