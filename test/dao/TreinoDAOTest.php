<?php
namespace test\dao;

use dao\TreinoDAO;
use model\Treino;
use PHPUnit\Framework\TestCase;

class TreinoDAOTest extends TestCase
{
    public function testInserir()
    {
        $treino = new Treino();
        $treino->setFocoTatico("Finalizacao");
        $treino->setIntensidade("Alta");
        $treino->setClima("Ensolarado");
        $treino->setDescricao("Treino tecnico com foco ofensivo");

        $treinoInserido = TreinoDAO::salvar($treino);

        $this->assertNotNull($treinoInserido->getId());
    }

    public function testListar()
    {
        $treinos = TreinoDAO::listar();

        foreach ($treinos as $treino) {
            echo $treino->getFocoTatico() . "\n";
        }

        $this->assertNotNull($treinos);
    }
}
