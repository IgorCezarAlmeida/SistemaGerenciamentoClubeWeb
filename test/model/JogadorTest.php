<?php


use model\Jogador;
use PHPUnit\Framework\TestCase;

class JogadorTest extends TestCase{
    public function testCadastrar(){
        $jogador = new Jogador();
        $jogador->setNome("Maria");
        $jogador->setNumeroCamisa("10");
        $jogador->setDataNascimento("01/01/1990");
        $this->assertNotNull($jogador);
    }
}
