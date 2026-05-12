<?php

namespace controller;

use dao\JogadorDAO;
use DateTime;
use Exception;
use model\Jogador;

class JogadorController {

    public function novo(){
        $jogador = new Jogador();
        require __DIR__ . "/../view/cadastro-jogador.php";
    }

    public function cadastrar(){
        try{
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
            $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $pesoKG =  filter_input(INPUT_POST, 'pesoKG', FILTER_SANITIZE_NUMBER_INT);
            $alturaCM= filter_input(INPUT_POST, 'alturaCM', FILTER_SANITIZE_NUMBER_FLOAT);
            $data_nascimento = filter_input(INPUT_POST, 'data_nascimento', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $disponivel  = filter_input(INPUT_POST, 'disponivel', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $numeroCamisa = filter_input(INPUT_POST, 'data_nascimento', FILTER_SANITIZE_NUMBER_INT);

            $jogador = $id ? JogadorDAO::buscarId($id) : new Jogador();
            if(empty($cliente))
                throw new Exception("Jogador não encontrado.");
            $jogador->setNome($nome);
            $jogador->setNumeroCamisa($numeroCamisa);
            $jogador->setDescricao($descricao);
            $jogador->setDisponivel($disponivel);
            $jogador->setAlturaCM($alturaCM);
            $jogador->setPesoKG($pesoKG);
            $jogador->setDataNascimento(new DateTime($data_nascimento));
            JogadorDAO::salvar($jogador);
            header('Location:' . BASE_URL . '/jogadores');
        }  catch(Exception $e){
            echo  'Falha ao salvar jogador.'. $e->getMessage();
            header('Location:' . BASE_URL . '/jogadores/novo');
        } finally {
            exit;
        }
    }
    public function editar(array $params)
    {
        try {
            $id = $params['id'];
            $jogador = JogadorDAO::buscarId($id);
            if (empty($jogador)) {
                throw new Exception("Jogador não encontrado");
            }
        } catch (Exception $ex) {
            echo "Falha ao buscar jogador" . $ex->getMessage();
        } finally {
            require __DIR__ . "/../view/cadastro-jogador.php";
        }
    }

    public function listar()
    {
        try {
            $jogadores = JogadorDAO::listar();
        } catch (Exception $ex) {
            echo "Falha ao listar os jogadores" . $ex->getMessage();
        } finally {
            require __DIR__ . "/../view/lista-jogadores.php";
        }
    }

    public function buscar(array $params)
    {
        try {
            $id = $params['id'];
            $jogador = JogadorDAO::buscarId($id);
            if (empty($jogador)) {
                throw new Exception("Jogador não encontrado");
            }
        } catch (Exception $ex) {
            echo "Falha ao buscar jogador" . $ex->getMessage();
        } finally {
            require __DIR__ . "/../view/visualizar-jogador.php";
        }
    }

    public function remover(array $params)
    {
        try {
            $id = $params['id'];
            $jogador = JogadorDAO::buscarId($id);
            if (empty($jogador)) {
                throw new Exception("Cliente não encontrado.");
            }
            JogadorDAO::deletar($jogador);
        } catch (Exception $ex) {
            echo "Falha ao remover jogador" . $ex->getMessage();
        } finally {
            header('Location: ' . BASE_URL . '/jogadores');
            exit;
        }
    }
}