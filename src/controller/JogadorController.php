<?php

namespace controller;

use utils\Facades\JogadorFacade;

class JogadorController {

    public function novo(){
        $jogador = null;
        $erro = $_SESSION['erro_cadastro'] ?? null;
        unset($_SESSION['erro_cadastro']);
        require __DIR__ . "/../view/cadastro-jogador.php";
    }

    public function cadastrar(){
        $dados = [
            'nome' => filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
            'pesoKG' => filter_input(INPUT_POST, 'pesoKG', FILTER_SANITIZE_NUMBER_INT),
            'alturaCM' => filter_input(INPUT_POST, 'alturaCM', FILTER_SANITIZE_NUMBER_FLOAT),
            'data_nascimento' => filter_input(INPUT_POST, 'data_nascimento', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
            'disponivel' => filter_input(INPUT_POST, 'disponivel', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
            'descricao' => filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
            'numeroCamisa' => filter_input(INPUT_POST, 'numeroCamisa', FILTER_SANITIZE_NUMBER_INT),
            'pernaDominante' => filter_input(INPUT_POST, 'pernaDominante', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
            'posicao' => filter_input(INPUT_POST, 'posicao', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
        ];

        $resultado = JogadorFacade::criar($dados);

        if ($resultado['sucesso']) {
            $_SESSION['sucesso'] = $resultado['mensagem'];
            header('Location: ' . BASE_URL . '/jogadores');
        } else {
            $_SESSION['erro_cadastro'] = $resultado['mensagem'];
            header('Location: ' . BASE_URL . '/jogadores/novo');
        }
        exit;
    }

    public function listar() {
        $resultado = JogadorFacade::listarTodos();
        $jogadores = $resultado['dados'];
        $erro = $resultado['sucesso'] ? null : $resultado['mensagem'];
        require __DIR__ . "/../view/lista-jogadores.php";
    }

    public function buscar(array $params) {
        $resultado = JogadorFacade::buscarPorId($params['id']);

        if ($resultado['sucesso']) {
            $jogador = $resultado['dados'];
            $erro = null;
        } else {
            $jogador = null;
            $erro = $resultado['mensagem'];
        }

        require __DIR__ . "/../view/visualizar-jogador.php";
    }

    public function editar(array $params) {
        $resultado = JogadorFacade::buscarPorId($params['id']);

        if ($resultado['sucesso']) {
            $jogador = $resultado['dados'];
            $erro = null;
        } else {
            $jogador = null;
            $erro = $resultado['mensagem'];
        }

        require __DIR__ . "/../view/cadastro-jogador.php";
    }

    public function remover(array $params) {
        $resultado = JogadorFacade::deletar($params['id']);

        if ($resultado['sucesso']) {
            $_SESSION['sucesso'] = $resultado['mensagem'];
        } else {
            $_SESSION['erro'] = $resultado['mensagem'];
        }

        header('Location: ' . BASE_URL . '/jogadores');
        exit;
    }
}