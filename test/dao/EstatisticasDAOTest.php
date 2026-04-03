<?php
namespace test\dao;

use dao\EstatisticasDAO;
use model\Estatisticas;
use PHPUnit\Framework\TestCase;

class EstatisticasDAOTest extends TestCase
{
    public function testInserir()
    {
        $estatisticas = new Estatisticas();
        $estatisticas->setGols(12);
        $estatisticas->setAssistencias(6);
        $estatisticas->setPasses(300);
        $estatisticas->setDesarmes(25);
        $estatisticas->setDefesas(0);
        $estatisticas->setMinutosJogados(1400);
        $estatisticas->setJogos(18);
        $estatisticas->setCartoesAmarelos(3);
        $estatisticas->setCartoesVermelhos(1);

        $estatisticasInseridas = EstatisticasDAO::salvar($estatisticas);

        $this->assertNotNull($estatisticasInseridas->getId());
    }

    public function testListar()
    {
        $estatisticas = EstatisticasDAO::listar();

        foreach ($estatisticas as $item) {
            echo $item->getGols() . "\n";
        }

        $this->assertNotNull($estatisticas);
    }
}