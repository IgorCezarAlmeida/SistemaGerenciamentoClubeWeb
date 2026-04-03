<?php
namespace model;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'tb_estatisticaAdversario')]
class EstatisticaAdversario extends GenericModel{
    #[ORM\Column(type: "string", length: 3)]
    private $posseBolaMedia;
    #[ORM\Column(type: "string", length: 3)]
    private $golsSofridos;
    #[ORM\Column(type: "string", length: 10)]
    private $formacaoComum;
    #[ORM\OneToOne(targetEntity: TimeAdversario::class, cascade: ['all'], orphanRemoval: true)]
    private $timeAdversario;
    #[ORM\OneToOne(targetEntity: Torneio::class, cascade: ['all'], orphanRemoval: true)]
    private $torneio;

    public function getPosseBolaMedia()
    {
        return $this->posseBolaMedia;
    }

    public function setPosseBolaMedia($posseBolaMedia): void
    {
        $this->posseBolaMedia = $posseBolaMedia;
    }

    public function getGolsSofridos()
    {
        return $this->golsSofridos;
    }

    public function setGolsSofridos($golsSofridos): void
    {
        $this->golsSofridos = $golsSofridos;
    }

    public function getFormacaoComum()
    {
        return $this->formacaoComum;
    }

    public function setFormacaoComum($formacaoComum): void
    {
        $this->formacaoComum = $formacaoComum;
    }

    public function getTimeAdversario()
    {
        return $this->timeAdversario;
    }

    public function setTimeAdversario($timeAdversario): void
    {
        $this->timeAdversario = $timeAdversario;
    }

    public function getTorneio()
    {
        return $this->torneio;
    }

    public function setTorneio($torneio): void
    {
        $this->torneio = $torneio;
    }


}