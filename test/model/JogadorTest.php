<?php


use dao\JogadorDAO;
use model\Contrato;
use model\Estatisticas;
use model\Jogador;
use model\Lesao;
use PHPUnit\Framework\TestCase;

class JogadorTest extends TestCase{
    public function testCadastrar(){
        $jogador = new Jogador();
        $jogador->setNome("Igor");
        $jogador->setNumeroCamisa("10");
        $jogador->setPernaDominante("Direita");
        $jogador->setDescricao("Experiente");
        $jogador->setPeso(70.2);
        $jogador->setAltura(170);
        $this->assertNotNull($jogador);
    }
    public function testBuscarId(){
        $jogador = new Jogador();
        $jogador->setNome("Igor");
        $jogador->setNumeroCamisa("10");
        $jogador->setPernaDominante("Direita");
        $jogador->setDescricao("Experiente");
        $jogador->setPeso(70.2);
        $jogador->setAltura(170);
        $jogador = JogadorDAO::salvar($jogador);

        $jogadorBuscado = JogadorDAO::buscarId($jogador->getId());
        $this->assertNotNull($jogadorBuscado->getId());
    }

    public function testDeletar(){
        $jogador = new Jogador();
        $jogador->setNome("Igor");
        $jogador->setNumeroCamisa("10");
        $jogador->setPernaDominante("Direita");
        $jogador->setDescricao("Experiente");
        $jogador->setPeso(70.2);
        $jogador->setAltura(170);
        $jogador = JogadorDAO::salvar($jogador);

        $jogadorDeletar = JogadorDAO::buscarId($jogador->getId());

        $idDeletar = $jogadorDeletar->getId();
        JogadorDAO::deletar($jogadorDeletar);

        $jogadorDeletado = JogadorDAO::buscarId($idDeletar);
        $this->assertNull($jogadorDeletado);

    }

    public function testBuscarNome(){
        $jogador = new Jogador();
        $jogador->setNome("Igor");
        $jogador->setNumeroCamisa("10");
        $jogador->setPernaDominante("Direita");
        $jogador->setDescricao("Experiente");
        $jogador->setPeso(70.2);
        $jogador->setAltura(170);
        $jogador = JogadorDAO::salvar($jogador);

        $jogadoresBuscados = JogadorDAO::buscarNome("Igor");
        $this->assertNotEmpty($jogadoresBuscados);
    }


    public function testBuscarNomeParecido(){
        $jogador = new Jogador();
        $jogador->setNome("Igor");
        $jogador->setNumeroCamisa("10");
        $jogador->setPernaDominante("Direita");
        $jogador->setDescricao("Experiente");
        $jogador->setPeso(70.2);
        $jogador->setAltura(170);
        $jogador = JogadorDAO::salvar($jogador);

        $jogadoresBuscados = JogadorDAO::buscarNomeParecido("Igo");
        $this->assertNotEmpty($jogadoresBuscados[0]);
    }

    // INSERÇÕES COM RELACIONAMENTO

    public function testInserirContrato(){
        $jogador = new Jogador();
        $jogador->setNome("Igor");
        $jogador->setNumeroCamisa("10");
        $jogador->setPernaDominante("Direita");
        $jogador->setDescricao("Experiente");
        $jogador->setPeso(70.2);
        $jogador->setAltura(170);

        $contrato = new Contrato();
        $contrato->setSalario(100000);
        $contrato->setTempoContrato(3);

        $jogador->setContrato($contrato);
        JogadorDAO::salvar($jogador);
        $this->assertNotNull($jogador->getContrato());
    }

    public function testInserirLesoes(){
        $jogador = new Jogador();
        $jogador->setNome("Igor");
        $jogador->setNumeroCamisa("10");
        $jogador->setPernaDominante("Direita");
        $jogador->setDescricao("Experiente");
        $jogador->setPeso(70.2);
        $jogador->setAltura(170);


        $lesao1 = new Lesao();
        $lesao1->setGravidadeLesao("leve");
        $lesao1->setInicioLesao("01/01/2026");
        $lesao1->setFimLesao("08/01/2026");
        $lesao1->setTipoLesao("Muscular");
        $lesao1->setObservacaoDP("Recuperado");
        $lesao1->setJogador($jogador);

        $lesao2 = new Lesao();
        $lesao1->setGravidadeLesao("leve");
        $lesao1->setInicioLesao("02/03/2026");
        $lesao1->setFimLesao("Sem previsão");
        $lesao1->setTipoLesao("Muscular");
        $lesao1->setObservacaoDP("Recuperado");
        $lesao2->setJogador($jogador);

        $lesoes[] = $lesao1;
        $lesoes[] = $lesao2;

        $jogador->setLesoes($lesoes);
        JogadorDAO::salvar($jogador);
        $this->assertNotEmpty($jogador->getLesoes());
    }

    public function testInserirEstatisticas(){
        $jogador = new Jogador();
        $jogador->setNome("Igor");
        $jogador->setNumeroCamisa("10");
        $jogador->setPernaDominante("Direita");
        $jogador->setDescricao("Experiente");
        $jogador->setPeso(70.2);
        $jogador->setAltura(170);

        $estatistica = new Estatisticas();
        $estatistica->setGols(11);
        $estatistica->setAssistencias(1);
        $estatistica->setCartoesAmarelos(1);
        $estatistica->setCartoesVermelhos(0);
        $estatistica->setMinutosJogados(1000);
        $estatistica->setJogos(30);
        $estatistica->setDefesas(0);
        $estatistica->setPasses(100);
        $estatistica->setDesarmes(2);

        $jogador->setContrato($estatistica);
        JogadorDAO::salvar($jogador);
        $this->assertNotNull($jogador->getEstatisticas());
    }
}
