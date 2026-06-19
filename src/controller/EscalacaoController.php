<?php
namespace controller;
use dao\EscalacaoDAO;
use model\Escalacao;

class EscalacaoController
{
    public function novo()
    {
        require __DIR__ . "/../view/cadastro-jogador.php";
    }

    public function cadastrar()
    {
        try {
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
            $esquemaTatico = filter_input(INPUT_POST, 'esquema_tatico', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $instrucoesGerais = filter_input(INPUT_POST, 'instrucoes_gerais', FILTER_SANITIZE_FULL_SPECIAL_CHARS);


            $escalacao = $id ? EscalacaoDAO::buscarId($id) : new Escalacao();
            if (empty($cliente))
                throw new Exception("Escalação não encontrada.");
            $escalacao->setEsquemaTatico($esquemaTatico);
            $escalacao->setInstrucoesGerais($instrucoesGerais);

            EscalacaoDAO::salvar($escalacao);
            header('Location:' . BASE_URL . '/escalacoes');
        } catch (Exception $e) {
            echo 'Falha ao salvar a Escalação.' . $e->getMessage();
            header('Location:' . BASE_URL . '/escalacoes/novo');
        } finally {
            exit;
        }
    }

    public function editar(array $params)
    {
        try {
            $id = $params['id'];
            $escalacao = EscalacaoDAO::buscarId($id);
            if (empty($escalacao)) {
                throw new Exception("Escalação não encontrada");
            }
        } catch (Exception $ex) {
            echo "Falha ao buscar escalaçao" . $ex->getMessage();
        } finally {
            require __DIR__ . "/../view/cadastro-escalacao.php";
        }
    }

    public function listar()
    {
        $escalacoes = [];
        try {
            $escalacoes = EscalacaoDAO::listar();
        } catch (Exception $ex) {
            echo "Falha ao listar as escalacoes" . $ex->getMessage();
        }
        $dadosDashboard = \controller\TecnicoController::getDadosDashboard(); // ✅
        require __DIR__ . "/../view/lista-escalacoes.php";
    }

    public function buscar(array $params)
    {
        try {
            $id = $params['id'];
            $escalacao = EscalacaoDAO::buscarId($id);
            if (empty($escalacao)) {
                throw new Exception("Escalação não encontrada");
            }
            $erro = null;
        } catch (Exception $ex) {
            $escalacao = null;
            $erro = "Falha ao buscar escalação: " . $ex->getMessage();
        }
        require __DIR__ . "/../view/visualizar-escalacao.php";
    }

    public function remover(array $params)
    {
        try {
            $id = $params['id'];
            $escalacao = EscalacaoDAO::buscarId($id);
            if (empty($escalacao)) {
                throw new Exception("Escalação não encontrada");
            }
            EscalacaoDAO::deletar($escalacao);
            $_SESSION['sucesso'] = 'Escalação removida com sucesso!';
        } catch (Exception $e) {
            $_SESSION['erro'] = 'Falha ao remover escalação: ' . $e->getMessage();
        }
        header('Location: ' . BASE_URL . '/escalacoes');
        exit;
    }
}