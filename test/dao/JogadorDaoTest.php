<?php
namespace test\dao;

use DateTime;
use  model\Lesao;
use dao\JogadorDAO;
use model\Jogador;
use PHPUnit\Framework\TestCase;


class JogadorDaoTest extends TestCase{

    public function testInserir(){
        $jogador = new Jogador();
        $jogador->setNome("Jogador");
        $jogador->setNumeroCamisa(33);
        $jogador->setDataNascimento(New DateTime("2000/01/01"));
        $jogador->setDisponivel("Disponivel");
        $jogador->setPesoKG(70);
        $jogador->setAlturaCM(170);
        $jogador->setDescricao("Jogador experiente");
        $jogador->setPernaDominante("direita");
        $jogador->setPosicao("atacante");

        $jogadorInserido = JogadorDAO::salvar($jogador);

        $this->assertNotNull($jogadorInserido->getId());
    }
    public function testListar(){
        $jogadores = JogadorDAO::listar();
        foreach ($jogadores as $jogador){
            echo $jogador->getNome(). "\n";
        }

        $this->assertNotNull($jogadores);
    }

    public function testInserirJogadorLesao(){
        $jogador = new Jogador();
        $jogador->setNome('Jogador');
        $jogador->setNumeroCamisa(44);
        $jogador->setDataNascimento(DateTime::createFromFormat('d/m/Y', '11/11/2000'));
        $jogador->setDisponivel("Disponivel");
        $jogador->setPesoKG(70);
        $jogador->setAlturaCM(170);
        $jogador->setDescricao("Jogador experiente");
        $jogador->setPernaDominante("direita");
        $jogador->setPosicao("atacante");

        $lesao1 = new Lesao();
        $lesao1->setTipoLesao("I");
        $lesao1->setInicioLesao("11/11/1111");
        $lesao1->setFimLesao("11/11/1111");
        $lesao1->setGravidadeLesao("leve");
        $lesao1->setObservacaoDP("Muito demorado");
        $lesao1->setJogador($jogador);

        $lesoes[] = $lesao1;
        $jogador->setLesoes($lesoes);  // Adicionado

        $jogadorInserido = JogadorDAO::salvar($jogador);
        $this->assertNotNull($jogadorInserido->getId());
    }
}