<?php
namespace test\dao;

use dao\ContratoDAO;
use model\Contrato;
use model\Jogador;
use PHPUnit\Framework\TestCase;

class ContratoDAOTest extends TestCase
{
    public function testInserir()
    {
        $jogador = new Jogador();
        $jogador->setNome("Pedro");
        $jogador->setNumeroCamisa(9);
        $jogador->setPeso(75);
        $jogador->setAltura(180);
        $jogador->setDescricao("Centroavante");
        $jogador->setPernaDominante("Direita");
        $jogador->setPosicao("Atacante");

        $contrato = new Contrato();
        $contrato->setTempoContrato("2027-12-31");
        $contrato->setSalario(25000);
        $contrato->setJogador($jogador);

        $contratoInserido = ContratoDAO::salvar($contrato);

        $this->assertNotNull($contratoInserido->getId());
    }

    public function testListar()
    {
        $contratos = ContratoDAO::listar();

        foreach ($contratos as $contrato) {
            echo $contrato->getSalario() . "\n";
        }

        $this->assertNotNull($contratos);
    }
}
