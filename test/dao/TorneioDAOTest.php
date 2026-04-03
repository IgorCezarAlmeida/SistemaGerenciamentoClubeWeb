<?php
namespace test\dao;

use dao\TorneioDAO;
use model\Torneio;
use PHPUnit\Framework\TestCase;

class TorneioDAOTest extends TestCase
{
    public function testInserir()
    {
        $torneio = new Torneio();
        $torneio->setNome("Campeonato Brasileiro 2026");
        $torneio->setTemporada("2026");
        $torneio->setOrganizador("CBF");
        $torneio->setTipo("Pontos corridos");

        $torneioInserido = TorneioDAO::salvar($torneio);

        $this->assertNotNull($torneioInserido->getId());
    }

    public function testListar()
    {
        $torneios = TorneioDAO::listar();

        foreach ($torneios as $torneio) {
            echo $torneio->getNome() . "\n";
        }

        $this->assertNotNull($torneios);
    }
}