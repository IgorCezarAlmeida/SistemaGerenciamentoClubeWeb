<?php
namespace controller;

use dao\JogadorDAO;
use dao\TecnicoDAO;
use utils\Facades\TecnicoFacade;

class TecnicoController {

    public function novo() {
        $tecnico = null;
        $erro = $_SESSION['erro_cadastro'] ?? null;
        unset($_SESSION['erro_cadastro']);
        require __DIR__ . "/../view/cadastrar-tecnico.php";
    }

    public function cadastrar() {
        $dados = [
            'id' => filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT),
            'nome' => filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
            'cpf' => filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
            'email' => filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL),
            'dataNascimento' => filter_input(INPUT_POST, 'dataNascimento', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
            'senha' => filter_input(INPUT_POST, 'senha', FILTER_UNSAFE_RAW),
        ];

        if ($dados['id']) {
            $resultado = TecnicoFacade::atualizar($dados['id'], $dados);
            $redirect = BASE_URL . '/tecnicos';
        } else {
            $resultado = TecnicoFacade::criar($dados);

            $redirect = BASE_URL . '/login';
        }

        if ($resultado['sucesso']) {
            $_SESSION['sucesso'] = $resultado['mensagem'];
        } else {
            $_SESSION['erro_cadastro'] = $resultado['mensagem'];
            $redirect = BASE_URL . '/tecnicos/novo';
        }

        header('Location: ' . $redirect);
        exit;
    }

    public function loginForm() {
        $error = $_SESSION['login_error'] ?? null;
        unset($_SESSION['login_error']);
        require __DIR__ . '/../view/login-tecnico.php';
    }
    public function autenticar() {
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $senha = filter_input(INPUT_POST, 'senha', FILTER_UNSAFE_RAW);

        $resultado = TecnicoFacade::autenticar($email, $senha);

        if ($resultado['sucesso']) {
            $_SESSION['tecnico_id'] = $resultado['dados']['id'];
            $_SESSION['tecnico_nome'] = $resultado['dados']['nome'];
            header('Location: ' . BASE_URL . '/menu');
        } else {
            $_SESSION['login_error'] = $resultado['mensagem'];
            header('Location: ' . BASE_URL . '/login');
        }
        exit;
    }

    public function logout() {
        session_unset();
        session_destroy();
        header('Location: ' . BASE_URL . '/login');
        exit;
    }

    public function listar() {
        $resultado = TecnicoFacade::listarTodos();
        $tecnicos = $resultado['dados'];
        require __DIR__ . "/../view/lista-tecnicos.php";
    }

    public function editar(array $params) {
        $resultado = TecnicoFacade::buscarPorId($params['id']);

        if ($resultado['sucesso']) {
            $tecnico = $resultado['dados'];
            $erro = null;
        } else {
            $tecnico = null;
            $erro = $resultado['mensagem'];
        }

        require __DIR__ . "/../view/cadastrar-tecnico.php";
    }

    public function remover(array $params) {
        $resultado = TecnicoFacade::deletar($params['id']);

        if ($resultado['sucesso']) {
            $_SESSION['sucesso'] = $resultado['mensagem'];
        } else {
            $_SESSION['erro'] = $resultado['mensagem'];
        }

        header('Location: ' . BASE_URL . '/tecnicos');
        exit;
    }

    public function menu(): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        $tecnicoId = $_SESSION['tecnico_id'] ?? null;
        if (!$tecnicoId) {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }

        $jogadorDAO = new JogadorDAO();
        $tecnicoDAO = new TecnicoDAO();

        $tecnico = TecnicoDAO::buscarId($tecnicoId); // ✅ estático

        $totalJogadores = $jogadorDAO->contarTodos();
        $jogadoresLesionados = $jogadorDAO->contarLesionados();
        $jogadoresDisponiveis = $jogadorDAO->contarDisponiveis();

        $dadosDashboard = [
            'nome_time' => $tecnico?->getNome() ?? 'Meu Time', // ✅ getter
            'total_jogadores' => (int) $totalJogadores,
            'jogadores_lesionados' => (int) $jogadoresLesionados,
            'jogadores_disponiveis' => (int) $jogadoresDisponiveis,
            'tecnico_nome' => $tecnico?->getNome() ?? ($_SESSION['tecnico_nome'] ?? 'Técnico'), // ✅ getter
        ];

        require __DIR__ . '/../view/menu-principal.php';
    }
    public static function getDadosDashboard(): array
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        $tecnicoId = $_SESSION['tecnico_id'] ?? null;
        if (!$tecnicoId) {
            return [
                'logado' => false,
                'tecnico_nome' => 'Convidado',
                'nome_time' => 'Meu Time',
                'total_jogadores' => 0,
                'jogadores_lesionados' => 0,
                'jogadores_disponiveis' => 0,
            ];
        }

        $jogadorDAO = new JogadorDAO();
        $tecnico = TecnicoDAO::buscarId($tecnicoId);

        return [
            'logado' => true,
            'nome_time' => $tecnico?->getNome() ?? 'Meu Time',
            'total_jogadores' => (int) $jogadorDAO->contarTodos(),
            'jogadores_lesionados' => (int) $jogadorDAO->contarLesionados(),
            'jogadores_disponiveis' => (int) $jogadorDAO->contarDisponiveis(),
            'tecnico_nome' => $tecnico?->getNome() ?? ($_SESSION['tecnico_nome'] ?? 'Técnico'),
        ];
    }
}