<?php

use model\Jogador;

class JogadorDaoTest extends TestCase{
    public function testInserir(){
        $jogador = new Jogador();
        $jogador->setNome('Jogador');
        $jogador->setNumeroCamisa(10);
        $jogador->setDataNascimento(new DateTime('2020-01-01'));
        $jogador->setEmail("iiii@email.com");
        $jogador->setSalario(2500);

    }
}