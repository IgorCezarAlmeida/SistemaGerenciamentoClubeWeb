<?php
namespace model;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'tb_treino')]
class Treino extends GenericModel{
    #[ORM\Column(type: 'String', length: 255)]
    private $focoTatico;
    #[ORM\Column(type: 'String', length: 50)]
    private $intensidade;
    #[ORM\Column(type: 'String', length: 50)]
    private $clima;
    #[ORM\Column(type: 'String', length: 255)]
    private $descricao;


    public function getFocoTatico()
    {
        return $this->focoTatico;
    }

    public function setFocoTatico($focoTatico): void
    {
        $this->focoTatico = $focoTatico;
    }

    public function getIntensidade()
    {
        return $this->intensidade;
    }

    public function setIntensidade($intensidade): void
    {
        $this->intensidade = $intensidade;
    }

    public function getClima()
    {
        return $this->clima;
    }

    public function setClima($clima): void
    {
        $this->clima = $clima;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function setDescricao($descricao): void
    {
        $this->descricao = $descricao;
    }


}