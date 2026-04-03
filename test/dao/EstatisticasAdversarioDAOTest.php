<?php
namespace test\dao;

use dao\EstatisticaAdversarioDAO;
use dao\EstatisticasDAO;
use model\EstatisticaAdversario;
use model\TimeAdversario;
use model\Torneio;
use PHPUnit\Framework\TestCase;

class EstatisticasAdversarioDAOTest extends TestCase
{
    public function testInserir()
    {
        $time = new TimeAdversario();
        $time->setNome("Gremio");
        $time->setEstiloDeJogoPredominante("Defensivo");
        $time->setPontosFortes("Marcacao");
        $time->setPontosFracos("Saida de bola");
        $time->setTecnicoAdversario("Renato");

        $torneio = new Torneio();
        $torneio->setNome("Copa do Brasil 2026");
        $torneio->setTemporada("2026");
        $torneio->setOrganizador("CBF");
        $torneio->setTipo("Mata-mata");

        $estatistica = new EstatisticaAdversario();
        $estatistica->setPosseBolaMedia("55");
        $estatistica->setGolsSofridos("10");
        $estatistica->setFormacaoComum("4-4-2");
        $estatistica->setTimeAdversario($time);
        $estatistica->setTorneio($torneio);

        $estatisticaInserida = EstatisticaAdversarioDAO::salvar($estatistica);

        $this->assertNotNull($estatisticaInserida->getId());
    }

    public function testListar()
    {
        $estatisticas = EstatisticaAdversarioDAO::listar();

        foreach ($estatisticas as $estatistica) {
            echo $estatistica->getFormacaoComum() . "\n";
        }

        $this->assertNotNull($estatisticas);
    }
}
