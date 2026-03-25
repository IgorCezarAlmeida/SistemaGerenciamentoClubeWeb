<?php
namespace model;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'tb_escalacao')]
class Escalacao extends GenericModel{
    #[ORM\Column(type: "String", length: 10)]
    private $esquemaTatico;
    #[ORM\Column(type: "String", length: 100)]
    private $instrucoesGerais;
    #[ORM\OneToOne(targetEntity: Jogo::class, cascade: ["all"], orphanRemoval: true)]
    private $jogo;
    #[ORM\ManyToMany(targetEntity: Jogador::class,cascade: ["all"])]
    private $jogador;

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
    public function getJogo()
    {
        return $this->jogo;
    }
    public function setJogo($jogo): void
    {
        $this->jogo = $jogo;
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