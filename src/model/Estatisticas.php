<?php
namespace model;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'tb_estatisticas')]
class Estatisticas extends GenericModel{
    #[ORM\Column(type: 'integer')]
    private $gols;
    #[ORM\Column(type: 'integer')]
    private $assistencias;
    #[ORM\Column(type: 'integer')]
    private $passes;
    #[ORM\Column(type: 'integer')]
    private $desarmes;
    #[ORM\Column(type: 'integer')]
    private $defesas;
    #[ORM\Column(type: 'integer')]
    private $minutosJogados;
    #[ORM\Column(type: 'integer')]
    private $jogos;
    #[ORM\Column(type: 'integer')]
    private $cartoesAmarelos;
    #[ORM\Column(type: 'integer')]
    private $cartoesVermelhos;

    public function getGols()
    {
        return $this->gols;
    }
    public function setGols($gols): void
    {
        $this->gols = $gols;
    }
    public function getAssistencias()
    {
        return $this->assistencias;
    }
    public function setAssistencias($assistencias): void
    {
        $this->assistencias = $assistencias;
    }
    public function getPasses()
    {
        return $this->passes;
    }
    public function setPasses($passes): void
    {
        $this->passes = $passes;
    }
    public function getDesarmes()
    {
        return $this->desarmes;
    }
    public function setDesarmes($desarmes): void
    {
        $this->desarmes = $desarmes;
    }
    public function getDefesas()
    {
        return $this->defesas;
    }
    public function setDefesas($defesas): void
    {
        $this->defesas = $defesas;
    }
    public function getMinutosJogados()
    {
        return $this->minutosJogados;
    }
    public function setMinutosJogados($minutosJogados): void
    {
        $this->minutosJogados = $minutosJogados;
    }
    public function getJogos()
    {
        return $this->jogos;
    }
    public function setJogos($jogos): void
    {
        $this->jogos = $jogos;
    }
    public function getCartoesAmarelos()
    {
        return $this->cartoesAmarelos;
    }
    public function setCartoesAmarelos($cartoesAmarelos): void
    {
        $this->cartoesAmarelos = $cartoesAmarelos;
    }
    public function getCartoesVermelhos()
    {
        return $this->cartoesVermelhos;
    }
    public function setCartoesVermelhos($cartoesVermelhos): void
    {
        $this->cartoesVermelhos = $cartoesVermelhos;
    }

}