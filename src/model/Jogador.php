<?php

namespace model;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'tb_jogador')]
class Jogador extends GenericModel{
    #[ORM\Column(type: 'string')]
    private $nome;
    #[ORM\Column(type: 'float')]
    private $peso;
    #[ORM\Column(type: 'string')]
    private $altura;
    #[ORM\Column(type: 'string')]
    private $numeroCamisa;
    #[ORM\Column(type: 'string')]
    private $descricao;
    #[ORM\Column(type: 'date')]
    private $dataNascimento;
    #[ORM\Column(type: 'string')]
    private $pernaDominante;
    #[ORM\Column(type: 'string')]
    private $posicao;
    #[ORM\JoinColumn(name: 'lesao_id')]
    #[ORM\ManyToOne(targetEntity: Lesao::class)]
    private $lesao;

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getNumeroCamisa()
    {
        return $this->NumeroCamisa;
    }

    public function setNumeroCamisa($numeroCamisa)
    {
        $this->numeroCamisa = $numeroCamisa;
    }

    public function getDataNascimento()
    {
        return $this->dataNascimento;
    }
    public function setDataNascimento($dataNascimento){
        $this->dataNascimento = $dataNascimento;
    }

    public function getPeso()
    {
        return $this->peso;
    }

    public function setPeso($peso): void
    {
        $this->peso = $peso;
    }

    public function getAltura()
    {
        return $this->altura;
    }

    public function setAltura($altura): void
    {
        $this->altura = $altura;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function setDescricao($descricao): void
    {
        $this->descricao = $descricao;
    }

    public function getPernaDominante()
    {
        return $this->pernaDominante;
    }

    public function setPernaDominante($pernaDominante): void
    {
        $this->pernaDominante = $pernaDominante;
    }

    public function getPosicao()
    {
        return $this->posicao;
    }

    public function setPosicao($posicao): void
    {
        $this->posicao = $posicao;
    }

}
