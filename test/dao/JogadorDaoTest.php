<?php
namespace test\dao;

use  model\Lesao;
use dao\JogadorDAO;
use model\Jogador;
use PHPUnit\Framework\TestCase;


class JogadorDaoTest extends TestCase{

    public function testInserir(){
        $jogador = new Jogador();
        $jogador->setNome("Jogador");
        $jogador->setNumeroCamisa(10);
        $jogador->setDataNascimento("11-11-1990");
        $jogador->setPeso(70);
        $jogador->setAltura(170);
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
        $jogador->setNumeroCamisa(10);
        $jogador->setDataNascimento('2020-01-01');
        $jogador->setPeso(70);
        $jogador->setAltura(170);
        $jogador->setDescricao("Jogador experiente");
        $jogador->setPernaDominante("direita");
        $jogador->setPosicao("atacante");

        $lesao1 = new Lesao();
        $lesao1->setTipoLesao("I");
        $lesao1->setInicioLesao("11/11/1111");
        $lesao1->setFimLesao("11/11/1111");
        $lesao1->setGravidadeLesao("leve");
        $lesao1->setObservacaoDP("Muy demorado");
        $lesao1->setJogador($jogador);

        $lesoes[] = $lesao1;

        $jogadorInserido = JogadorDAO::salvar($jogador);
        $this->assertNotNull($jogadorInserido->getId());
    }

    public function testDeletarJogador(){

}
}