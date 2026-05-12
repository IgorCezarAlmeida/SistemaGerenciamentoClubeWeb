<?php

use dao\EstatisticasDAO;
use model\Estatisticas;

class EstatisticasController{
    public function novo()
    {
        require __DIR__ . "/../view/cadastro-estatisticas.php";
    }

    public function cadastrar()
    {
        try {
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
            $gols = filter_input(INPUT_POST, 'gols', FILTER_SANITIZE_NUMBER_INT);
            $assistencias =  filter_input(INPUT_POST, 'assistencias', FILTER_SANITIZE_NUMBER_INT);
            $passes =  filter_input(INPUT_POST, 'passes', FILTER_SANITIZE_NUMBER_INT);
            $desarmes =  filter_input(INPUT_POST, 'desarmes', FILTER_SANITIZE_NUMBER_INT);
            $defesas=  filter_input(INPUT_POST, 'defesas', FILTER_SANITIZE_NUMBER_INT);
            $minutosJogados =  filter_input(INPUT_POST, 'minutos_jogados', FILTER_SANITIZE_NUMBER_INT);
            $jogos = filter_input(INPUT_POST, 'jogos', FILTER_SANITIZE_NUMBER_INT);
            $cartoesAmarelos = filter_input(INPUT_POST, 'cartoes_amarelos)', FILTER_SANITIZE_NUMBER_INT);
            $cartoesVermelhos = filter_input(INPUT_POST, 'cartoes_vermelhos', FILTER_SANITIZE_NUMBER_INT);

            $estatisticas = $id ? EstatisticasDAO::buscarId($id) : new Estatisticas();
            if(empty($cliente))
                throw new Exception("Estatisticas não encontradas.");
            $estatisticas->setGols($gols);
            $estatisticas->setAssistencias($assistencias);
            $estatisticas->setPasses($passes);
            $estatisticas->setDesarmes($desarmes);
            $estatisticas->setDefesas($defesas);
            $estatisticas->setMinutosJogados($minutosJogados);
            $estatisticas->setJogos($jogos);
            $estatisticas->setCartoesAmarelos($cartoesAmarelos);
            $estatisticas->setCartoesVermelhos($cartoesVermelhos);

            EstatisticasDAO::salvar($estatisticas);
            header('Location:' . BASE_URL . '/estatisticas');
        } catch (Exception $e) {
            echo 'Falha ao salvar a Estatistica.' . $e->getMessage();
            header('Location:' . BASE_URL . '/estatisticas/novo');
        } finally {
            exit;
        }
    }
    public function editar(array $params)
    {
        try {
            $id = $params['id'];
            $jogador = EstatisticasDAO::buscarId($id);
            if (empty($jogador)) {
                throw new Exception("Estatisticas não encontradas");
            }
        } catch (Exception $ex) {
            echo "Falha ao buscar Estatistica" . $ex->getMessage();
        } finally {
            require __DIR__ . "/../view/estatisticas-jogadores.php";
        }
    }
    public function listar()
    {
        try {
            $estatisticas = EstatisticasDAO::listar();
        } catch (Exception $ex) {
            echo "Falha ao listar as estatisticas" . $ex->getMessage();
        } finally {
            require __DIR__ . "/../view/estatisticas-jogadores.php";
        }
    }

    public function buscar(array $params)
    {
        try {
            $id = $params['id'];
            $estatistica = EstatisticasDAO::buscarId($id);
            if (empty($estatistica)) {
                throw new Exception("Estatistica não encontrado");
            }
        } catch (Exception $ex) {
            echo "Falha ao buscar Estatistica" . $ex->getMessage();
        } finally {
            require __DIR__ . "/../view/visualizar-estatistica.php";
        }
    }
}