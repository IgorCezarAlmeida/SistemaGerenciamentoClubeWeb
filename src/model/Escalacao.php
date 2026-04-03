<?php
namespace model;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'tb_escalacao')]
class Escalacao extends GenericModel{
    #[ORM\Column(type: "string", length: 10)]
    private $esquemaTatico;
    #[ORM\Column(type: "string", length: 100)]
    private $instrucoesGerais;
    #[ORM\OneToOne(targetEntity: Partida::class, cascade: ["all"], orphanRemoval: true)]
    private $partida;

    #[ORM\ManyToMany(targetEntity: Jogador::class)]
    #[ORM\JoinTable(name: "tb_escalacao_jogador")]
    #[ORM\JoinColumn(name: "escalacao_id",referencedColumnName: "id")]
    #[ORM\InverseJoinColumn(name: "jogador_id", referencedColumnName: "id")]
    private $jogadoresEscalados;


    public function getEsquemaTatico()
    {
        return $this->esquemaTatico;
    }
    public function setEsquemaTatico($esquemaTatico): void
    {
        $this->esquemaTatico = $esquemaTatico;
    }
    public function getInstrucoesGerais()
    {
        return $this->instrucoesGerais;
    }
    public function setInstrucoesGerais($instrucoesGerais): void
    {
        $this->instrucoesGerais = $instrucoesGerais;
    }
    public function getPartida()
    {
        return $this->partida;
    }
    public function setPartida($partida): void
    {
        $this->$partida = $partida;
    }

    public function getJogador()
    {
        return $this->jogador;
    }

    public function setJogador($jogador): void
    {
        $this->jogador = $jogador;
    }

    public function getJogadoresEscalados()
    {
        return $this->jogadoresEscalados;
    }

    public function setJogadoresEscalados($jogadoresEscalados): void
    {
        $this->jogadoresEscalados = $jogadoresEscalados;
    }


}