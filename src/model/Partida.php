<?php
namespace model;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'tb_partida')]
class Partida extends GenericModel{
    #[ORM\Column(type: "date")]
    private $data;
    #[ORM\Column(type: "datetime")]
    private $hora;
    #[ORM\Column(type: "string", length: 100)]
    private $local;
    #[ORM\OneToMany(mappedBy:"partida",targetEntity: Torneio::class,cascade: ['all'], orphanRemoval: true)]
    private $torneio;
    #[ORM\JoinColumn(name: 'jogo_id')]
    #[ORM\ManyToOne(targetEntity: Jogo::class)]
    private $jogo;

    public function getData()
    {
        return $this->data;
    }

    public function setData($data): void
    {
        $this->data = $data;
    }

    public function getHora()
    {
        return $this->hora;
    }

    public function setHora($hora): void
    {
        $this->hora = $hora;
    }

    public function getLocal()
    {
        return $this->local;
    }

    public function setLocal($local): void
    {
        $this->local = $local;
    }

    public function getTorneio()
    {
        return $this->torneio;
    }

    public function setTorneio($torneio): void
    {
        $this->torneio = $torneio;
    }

    public function getJogo()
    {
        return $this->jogo;
    }

    public function setJogo($jogo): void
    {
        $this->jogo = $jogo;
    }

}