<?php
namespace test\dao;

use dao\TimeAdversarioDAO;
use model\TimeAdversario;
use PHPUnit\Framework\TestCase;

class TimeAdversarioDAOTest extends TestCase
{
    public function testInserir()
    {
        $time = new TimeAdversario();
        $time->setNome("Palmeiras");
        $time->setEstiloDeJogoPredominante("Posse de bola");
        $time->setPontosFortes("Bola parada");
        $time->setPontosFracos("Contra-ataque");
        $time->setTecnicoAdversario("Abel Ferreira");

        $timeInserido = TimeAdversarioDAO::salvar($time);

        $this->assertNotNull($timeInserido->getId());
    }

    public function testListar()
    {
        $times = TimeAdversarioDAO::listar();

        foreach ($times as $time) {
            echo $time->getNome() . "\n";
        }

        $this->assertNotNull($times);
    }
}