<?php

namespace test\utils\Facades;

use utils\Facades\JogadorFacade;
use utils\Facades\TecnicoFacade;
use PHPUnit\Framework\TestCase;


class FacadeTest extends TestCase
{

    public function testCriarJogadorComSucesso()
    {
        $dados = [
            'nome' => 'Neymar Jr',
            'numeroCamisa' => 10,
            'pesoKG' => 68,
            'alturaCM' => 175,
            'data_nascimento' => '1992-02-05',
            'disponivel' => 'sim',
            'posicao' => 'atacante',
            'pernaDominante' => 'esquerda',
            'descricao' => 'Jogador talentoso'
        ];

        $resultado = JogadorFacade::criar($dados);

        $this->assertTrue($resultado['sucesso']);
        $this->assertArrayHasKey('dados', $resultado);
        $this->assertEquals('Jogador criado com sucesso', $resultado['mensagem']);
    }

    /**
     * Testa validação de número de camisa inválido
     */
    public function testCriarJogadorNumeroCamisaInvalido()
    {
        $dados = [
            'nome' => 'João Silva',
            'numeroCamisa' => 150,  // Inválido: > 99
            'pesoKG' => 75,
            'alturaCM' => 180,
            'data_nascimento' => '2000-05-15',
            'disponivel' => 'sim',
            'posicao' => 'meia',
            'pernaDominante' => 'direita'
        ];

        $resultado = JogadorFacade::criar($dados);

        $this->assertFalse($resultado['sucesso']);
        $this->assertStringContainsString('camisa', strtolower($resultado['mensagem']));
    }

    /**
     * Testa validação de peso inválido
     */
    public function testCriarJogadorPesoInvalido()
    {
        $dados = [
            'nome' => 'João Silva',
            'numeroCamisa' => 7,
            'pesoKG' => 25,  // Inválido: < 30
            'alturaCM' => 180,
            'data_nascimento' => '2000-05-15',
            'disponivel' => 'sim',
            'posicao' => 'meia',
            'pernaDominante' => 'direita'
        ];

        $resultado = JogadorFacade::criar($dados);

        $this->assertFalse($resultado['sucesso']);
        $this->assertStringContainsString('peso', strtolower($resultado['mensagem']));
    }

    /**
     * Testa validação de altura inválida
     */
    public function testCriarJogadorAlturaInvalida()
    {
        $dados = [
            'nome' => 'João Silva',
            'numeroCamisa' => 7,
            'pesoKG' => 75,
            'alturaCM' => 130,  // Inválido: < 140
            'data_nascimento' => '2000-05-15',
            'disponivel' => 'sim',
            'posicao' => 'meia',
            'pernaDominante' => 'direita'
        ];

        $resultado = JogadorFacade::criar($dados);

        $this->assertFalse($resultado['sucesso']);
        $this->assertStringContainsString('altura', strtolower($resultado['mensagem']));
    }

    /**
     * Testa busca de jogador por ID válido
     */
    public function testBuscarJogadorPorId()
    {
        // Primeiro criar um jogador
        $dados = [
            'nome' => 'Teste Busca',
            'numeroCamisa' => 99,
            'pesoKG' => 80,
            'alturaCM' => 185,
            'data_nascimento' => '1995-03-10',
            'disponivel' => 'sim',
            'posicao' => 'goleiro',
            'pernaDominante' => 'direita'
        ];

        $resultadoCriacao = JogadorFacade::criar($dados);

        if ($resultadoCriacao['sucesso']) {
            $idJogador = $resultadoCriacao['dados']->getId();

            // Agora buscar
            $resultado = JogadorFacade::buscarPorId($idJogador);

            $this->assertTrue($resultado['sucesso']);
            $this->assertEquals('Teste Busca', $resultado['dados']->getNome());
        }
    }

    /**
     * Testa busca com ID inválido
     */
    public function testBuscarJogadorIdInvalido()
    {
        $resultado = JogadorFacade::buscarPorId(-1);

        $this->assertFalse($resultado['sucesso']);
        $this->assertStringContainsString('inválido', strtolower($resultado['mensagem']));
    }

    /**
     * Testa listar todos os jogadores
     */
    public function testListarTodosJogadores()
    {
        $resultado = JogadorFacade::listarTodos();

        $this->assertTrue($resultado['sucesso']);
        $this->assertArrayHasKey('dados', $resultado);
        $this->assertArrayHasKey('total', $resultado);
        $this->assertIsArray($resultado['dados']);
    }

    /**
     * Testa autenticação de técnico com sucesso
     */
    public function testAutenticarTecnicoComSucesso()
    {
        // Primeiro criar um técnico
        $dadosCriacao = [
            'nome' => 'Técnico Teste',
            'cpf' => '12345678901',
            'email' => 'tecnico.teste@exemplo.com',
            'dataNascimento' => '1970-01-01',
            'senha' => 'senha123'
        ];

        $resultadoCriacao = TecnicoFacade::criar($dadosCriacao);

        if ($resultadoCriacao['sucesso']) {
            // Agora autenticar
            $resultado = TecnicoFacade::autenticar('tecnico.teste@exemplo.com', 'senha123');

            $this->assertTrue($resultado['sucesso']);
            $this->assertArrayHasKey('dados', $resultado);
            $this->assertEquals('Técnico Teste', $resultado['dados']['nome']);
        }
    }

    /**
     * Testa autenticação com senha inválida
     */
    public function testAutenticarTecnicoSenhaInvalida()
    {
        // Primeiro criar um técnico
        $dadosCriacao = [
            'nome' => 'Técnico Teste 2',
            'cpf' => '11111111111',
            'email' => 'tecnico.teste2@exemplo.com',
            'dataNascimento' => '1970-01-01',
            'senha' => 'senha123'
        ];

        TecnicoFacade::criar($dadosCriacao);

        // Tentar autenticar com senha errada
        $resultado = TecnicoFacade::autenticar('tecnico.teste2@example.com', 'senhaErrada');

        $this->assertFalse($resultado['sucesso']);
        $this->assertStringContainsString('inválida', strtolower($resultado['mensagem']));
    }

    /**
     * Testa validação de CPF inválido
     */
    public function testCriarTecnicoCpfInvalido()
    {
        $dados = [
            'nome' => 'Técnico Inválido',
            'cpf' => '123',  // Inválido: não tem 11 dígitos
            'email' => 'teste@example.com',
            'dataNascimento' => '1970-01-01',
            'senha' => 'senha123'
        ];

        $resultado = TecnicoFacade::criar($dados);

        $this->assertFalse($resultado['sucesso']);
        $this->assertStringContainsString('cpf', strtolower($resultado['mensagem']));
    }

    /**
     * Testa validação de email inválido
     */
    public function testCriarTecnicoEmailInvalido()
    {
        $dados = [
            'nome' => 'Técnico Email Inválido',
            'cpf' => '22222222222',
            'email' => 'nao-e-um-email',  // Inválido
            'dataNascimento' => '1970-01-01',
            'senha' => 'senha123'
        ];

        $resultado = TecnicoFacade::criar($dados);

        $this->assertFalse($resultado['sucesso']);
        $this->assertStringContainsString('email', strtolower($resultado['mensagem']));
    }

    /**
     * Testa validação de senha curta
     */
    public function testCriarTecnicoSenha()
    {
        $dados = [
            'nome' => 'Técnico Senha Curta',
            'cpf' => '33333333333',
            'email' => 'teste.senha@example.com',
            'dataNascimento' => '1970-01-01',
            'senha' => '123'  // Inválido: < 6 caracteres
        ];

        $resultado = TecnicoFacade::criar($dados);

        $this->assertFalse($resultado['sucesso']);
        $this->assertStringContainsString('senha', strtolower($resultado['mensagem']));
    }

    /**
     * Testa padrão de resposta da Façade
     */
    public function testPadraoRespostaFacade()
    {
        $dados = [
            'nome' => 'Padrão Teste',
            'numeroCamisa' => 5,
            'pesoKG' => 70,
            'alturaCM' => 170,
            'data_nascimento' => '2000-01-01',
            'disponivel' => 'não',
            'posicao' => 'zagueiro',
            'pernaDominante' => 'esquerda'
        ];

        $resultado = JogadorFacade::criar($dados);

        // Validar estrutura padrão
        $this->assertIsArray($resultado);
        $this->assertArrayHasKey('sucesso', $resultado);
        $this->assertArrayHasKey('mensagem', $resultado);
        $this->assertIsString($resultado['mensagem']);
        $this->assertIsBool($resultado['sucesso']);
    }
}

