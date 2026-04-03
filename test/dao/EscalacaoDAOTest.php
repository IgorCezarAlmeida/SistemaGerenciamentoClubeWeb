<?php
namespace test\dao;

use dao\EscalacaoDAO;
use model\Escalacao;
use model\Jogador;
use PHPUnit\Framework\TestCase;

class EscalacaoDAOTest extends TestCase
{
    public function testInserir()
    {
        $jogador1 = new Jogador();
        $jogador1->setNome("Joao");
        $jogador1->setNumeroCamisa(8);
        $jogador1->setPeso(70);
        $jogador1->setAltura(175);
        $jogador1->setDescricao("Meio campo");
        $jogador1->setPernaDominante("Direita");
        $jogador1->setPosicao("Meia");

        $jogador2 = new Jogador();
        $jogador2->setNome("Lucas");
        $jogador2->setNumeroCamisa(9);
        $jogador2->setPeso(79);
        $jogador2->setAltura(183);
        $jogador2->setDescricao("Atacante");
        $jogador2->setPernaDominante("Esquerda");
        $jogador2->setPosicao("Atacante");

        $jogadores = [];
        $jogadores[] = $jogador1;
        $jogadores[] = $jogador2;

        $escalacao = new Escalacao();
        $escalacao->setEsquemaTatico("4-3-3");
        $escalacao->setInstrucoesGerais("Pressao alta");
        $escalacao->setJogadoresEscalados($jogadores);

        $escalacaoInserida = EscalacaoDAO::salvar($escalacao);

        $this->assertNotNull($escalacaoInserida->getId());
    }

    public function testListar()
    {
        $escalacoes = EscalacaoDAO::listar();

        foreach ($escalacoes as $escalacao) {
            echo $escalacao->getEsquemaTatico() . "\n";
        }

        $this->assertNotNull($escalacoes);
    }
}
