<?php
namespace test\dao;

use dao\PartidaDAO;
use model\Partida;
use model\TimeAdversario;
use model\Torneio;
use PHPUnit\Framework\TestCase;

class PartidaDAOTest extends TestCase
{
    public function testInserir()
    {
        $torneio = new Torneio();
        $torneio->setNome("Libertadores 2026");
        $torneio->setTemporada("2026");
        $torneio->setOrganizador("CONMEBOL");
        $torneio->setTipo("Mata-mata");

        $adversario = new TimeAdversario();
        $adversario->setNome("River Plate");
        $adversario->setEstiloDeJogoPredominante("Ofensivo");
        $adversario->setPontosFortes("Velocidade");
        $adversario->setPontosFracos("Defesa lenta");
        $adversario->setTecnicoAdversario("Demichelis");

        $partida = new Partida();
        $partida->setData("2026-05-10");
        $partida->setHora("2026-05-10 21:30:00");
        $partida->setLocal("Maracana");
        $partida->setMandoDeCampo("Casa");
        $partida->setResultadoFinal("2x1");
        $partida->setTimeadversario($adversario);
        $partida->setTorneio($torneio);

        $partidaInserida = PartidaDAO::salvar($partida);

        $this->assertNotNull($partidaInserida->getId());
    }

    public function testListar()
    {
        $partidas = PartidaDAO::listar();

        foreach ($partidas as $partida) {
            echo $partida->getLocal() . "\n";
        }

        $this->assertNotNull($partidas);
    }
}
