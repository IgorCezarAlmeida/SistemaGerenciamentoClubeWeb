<?php

namespace model;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'tb_jogador')]
class Jogador extends GenericModel{
    #[ORM\Column(type: 'string')]
    private $nome;
    #[ORM\Column(type: 'string')]
    private $email;
    #[ORM\Column(type: 'string')]
    private $numeroCamisa;
    #[ORM\Column(type: 'string')]
    private $salario;
    #[ORM\Column(type: 'date')]
    private $dataNascimento;

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getNumeroCamisa()
    {
        return $this->NumeroCamisa;
    }

    public function setNumeroCamisa($numeroCamisa)
    {
        $this->numeroCamisa = $numeroCamisa;
    }

    public function getSalario()
    {
        return $this->salario;
    }

    public function  setSalario($salario){
        $this->salario = $salario;
    }

    public function getDataNascimento()
    {
        return $this->dataNascimento;
    }
    public function setDataNascimento($dataNascimento){
        $this->dataNascimento = $dataNascimento;
    }
}
