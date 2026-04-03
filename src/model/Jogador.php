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
    #[ORM\Column(type: 'string')]
    private $pernaDominante;
    #[ORM\Column(type: 'string')]
    private $posicao;
    #[ORM\OneToMany(mappedBy: "jogador",targetEntity: Lesao::class,cascade: ["all"], orphanRemoval: true)]
    private $lesoes;
    #[ORM\OneToOne(targetEntity: Contrato::class, cascade: ['all'], orphanRemoval: true, fetch: 'EAGER')]
    #[ORM\JoinColumn(name: "contrato_id")]
    private $contrato;
    #[ORM\OneToOne(targetEntity: Estatisticas::class, cascade: ['all'], orphanRemoval: true, fetch: 'EAGER')]
    #[ORM\JoinColumn(name: "estatisticas_id")]
    private $estatisticas;
    #[ORM\ManyToMany(targetEntity: Escalacao::class,mappedBy: "jogadoresEscalados")]
    private $escalacoesJogador;

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
        return $this->numeroCamisa;
    }

    public function setNumeroCamisa($numeroCamisa)
    {
        $this->numeroCamisa = $numeroCamisa;
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

    public function getLesoes()
    {
        return $this->lesoes;
    }

    public function setLesoes($lesoes): void
    {
        $this->lesoes = $lesoes;
    }

    public function getContrato()
    {
        return $this->contrato;
    }

    public function setContrato($contrato): void
    {
        $this->contrato = $contrato;
    }

    public function getEscalacoesJogador()
    {
        return $this->escalacoesJogador;
    }

    public function setEscalacoesJogador($escalacoesJogador): void
    {
        $this->escalacoesJogador = $escalacoesJogador;
    }

    public function getEstatisticas()
    {
        return $this->estatisticas;
    }

    public function setEstatisticas($estatisticas): void
    {
        $this->estatisticas = $estatisticas;
    }


}
