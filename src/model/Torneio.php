<?php
namespace model;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'tb_torneio')]
class Torneio extends GenericModel{
    #[ORM\Column(type: 'String', length: 255,unique: true)]
    private $nome;
    #[ORM\Column(type: 'String', length: 255)]
    private $temporada;
    #[ORM\Column(type: 'String', length: 255)]
    private $organizador;
    #[ORM\Column(type: 'String', length: 255)]
    private $tipo;
    #[ORM\JoinColumn(name: 'partida_id')]
    #[ORM\ManyToOne(targetEntity: Partida::class)]
    private $partida;

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome): void
    {
        $this->nome = $nome;
    }

    public function getTemporada()
    {
        return $this->temporada;
    }

    public function setTemporada($temporada): void
    {
        $this->temporada = $temporada;
    }

    public function getOrganizador()
    {
        return $this->organizador;
    }

    public function setOrganizador($organizador): void
    {
        $this->organizador = $organizador;
    }

    public function getTipo()
    {
        return $this->tipo;
    }

    public function setTipo($tipo): void
    {
        $this->tipo = $tipo;
    }


}