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
    #[ORM\Column(type: "string",length: 50)]
    private $mandoDeCampo;
    #[ORM\Column(type: "string",length: 8)]
    private $resultadoFinal;
    #[ORM\JoinColumn(name: "timeAdversario_id")]
    #[ORM\ManyToOne(targetEntity: TimeAdversario::class)]
    private $Timeadversario;
    #[ORM\JoinColumn(name: 'torneio_id')]
    #[ORM\ManyToOne(targetEntity: Torneio::class)]
    private $torneio;

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

    public function getMandoDeCampo()
    {
        return $this->mandoDeCampo;
    }

    public function setMandoDeCampo($mandoDeCampo): void
    {
        $this->mandoDeCampo = $mandoDeCampo;
    }

    public function getResultadoFinal()
    {
        return $this->resultadoFinal;
    }

    public function setResultadoFinal($resultadoFinal): void
    {
        $this->resultadoFinal = $resultadoFinal;
    }

    public function getTimeadversario()
    {
        return $this->Timeadversario;
    }

    public function setTimeadversario($Timeadversario): void
    {
        $this->Timeadversario = $Timeadversario;
    }


}