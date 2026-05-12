<?php
namespace test\dao;

use dao\LesaoDAO;
use model\Jogador;
use model\Lesao;
use PHPUnit\Framework\TestCase;

class LesaoDAOTest extends TestCase
{
    public function testInserir()
    {
        $jogador = new Jogador();
        $jogador->setNome("Carlos");
        $jogador->setNumeroCamisa(5);
        $jogador->setPesoKG(78);
        $jogador->setAltura(182);
        $jogador->setDescricao("Zagueiro");
        $jogador->setPernaDominante("Direita");
        $jogador->setPosicao("Defensor");

        $lesao = new Lesao();
        $lesao->setTipoLesao("Entorse");
        $lesao->setGravidadeLesao("Moderada");
        $lesao->setInicioLesao("2026-03-01");
        $lesao->setFimLesao("2026-03-20");
        $lesao->setObservacaoDP("Recuperacao em andamento");
        $lesao->setJogador($jogador);

        $lesaoInserida = LesaoDAO::salvar($lesao);

        $this->assertNotNull($lesaoInserida->getId());
    }

    public function testListar()
    {
        $lesoes = LesaoDAO::listar();

        foreach ($lesoes as $lesao) {
            echo $lesao->getTipoLesao() . "\n";
        }

        $this->assertNotNull($lesoes);
    }
}
