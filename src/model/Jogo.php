<?php
namespace  model;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'tb_Jogo')]
class Jogo extends GenericModel{
    #[ORM\Column(type: "String",length: 50)]
    private $mandoDeCampo;
    #[ORM\Column(type: "String",length: 8)]
    private $resultadoFinal;
    #[ORM\OneToMany(mappedBy: "jogo",targetEntity: Partida::class,cascade: ["all"])]
    private $partida;
    #[ORM\OneToMany(mappedBy: "jogo",targetEntity: TimeAdversario::class,cascade: ["all"])]
    private $Timeadversario;

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

    public function getPartida()
    {
        return $this->partida;
    }

    public function setPartida($partida): void
    {
        $this->partida = $partida;
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