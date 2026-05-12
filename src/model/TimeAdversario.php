<?php
namespace model;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'tb_Time_Adversario')]
class TimeAdversario extends GenericModel{
    #[ORM\Column(type: 'string', length: 50, unique: true)]
    private $nome;
    #[ORM\Column(type: 'string', length: 200)]
    private $estiloDeJogoPredominante;
    #[ORM\Column(type: 'string', length: 200)]
    private $pontosFortes;
    #[ORM\Column(type: 'string', length: 200)]
    private $pontosFracos;
    #[ORM\Column(type: 'string', length: 100)]
    private $tecnicoAdversario;
    #[ORM\OneToMany(mappedBy:"timeAdversario",targetEntity: Partida::class,cascade: ['all'], orphanRemoval: true)]
    private $partidas;

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome): void
    {
        $this->nome = $nome;
    }

    public function getEstiloDeJogoPredominante()
    {
        return $this->estiloDeJogoPredominante;
    }

    public function setEstiloDeJogoPredominante($estiloDeJogoPredominante): void
    {
        $this->estiloDeJogoPredominante = $estiloDeJogoPredominante;
    }

    public function getPontosFortes()
    {
        return $this->pontosFortes;
    }

    public function setPontosFortes($pontosFortes): void
    {
        $this->pontosFortes = $pontosFortes;
    }

    public function getPontosFracos()
    {
        return $this->pontosFracos;
    }

    public function setPontosFracos($pontosFracos): void
    {
        $this->pontosFracos = $pontosFracos;
    }

    public function getTecnicoAdversario()
    {
        return $this->tecnicoAdversario;
    }

    public function setTecnicoAdversario($tecnicoAdversario): void
    {
        $this->tecnicoAdversario = $tecnicoAdversario;
    }

    public function getPartidas()
    {
        return $this->partidas;
    }

    public function setPartidas($partidas): void
    {
        $this->partidas = $partidas;
    }

}