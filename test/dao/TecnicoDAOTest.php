<?php
namespace test\dao;

use dao\TecnicoDAO;
use model\Tecnico;
use PHPUnit\Framework\TestCase;

class TecnicoDAOTest extends TestCase
{
    public function testInserir()
    {
        $tecnico = new Tecnico();
        $tecnico->setNome("Tecnico Principal");
        $tecnico->setDataNascimento("1980-05-10");
        $tecnico->setSenha("123456");

        $tecnicoInserido = TecnicoDAO::salvar($tecnico);

        $this->assertNotNull($tecnicoInserido->getId());
    }

    public function testListar()
    {
        $tecnicos = TecnicoDAO::listar();

        foreach ($tecnicos as $tecnico) {
            echo $tecnico->getNome() . "\n";
        }

        $this->assertNotNull($tecnicos);
    }
}
