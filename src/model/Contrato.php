<?php
namespace model;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'tb_contrato')]
class Contrato extends GenericModel {
    #[ORM\Column(type: 'date')]
    private $tempoContrato;
    #[ORM\Column(type: 'float')]
    private $salario;

    #[ORM\OneToOne(targetEntity: Jogador::class,cascade: ["all"])]
    private $jogador;

    public function getTempoContrato()
    {
        return $this->tempoContrato;
    }

    public function setTempoContrato($tempoContrato): void
    {
        $this->tempoContrato = $tempoContrato;
    }

    public function getSalario()
    {
        return $this->salario;
    }

    public function setSalario($salario): void
    {
        $this->salario = $salario;
    }

    public function getJogador()
    {
        return $this->jogador;
    }

    public function setJogador($jogador): void
    {
        $this->jogador = $jogador;
    }


}