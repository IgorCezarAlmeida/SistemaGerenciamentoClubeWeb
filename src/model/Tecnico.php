<?php

namespace model;

use Doctrine\ORM\Mapping as ORM;
use model\GenericModel;

#[ORM\Entity]
#[ORM\Table(name: 'tb_tecnico')]
class Tecnico extends GenericModel
{
    #[ORM\Column(type: 'string')]
    private $nome;
    #[ORM\Column(type: 'date')]
    private $dataNascimento;
    #[ORM\Column(type: 'string')]
    private $cpf;
    #[ORM\Column(type: 'string')]
    private $email;
    #[ORM\Column(type: 'string')]
    private $senha;

    public function getNome()
    {
        return $this->nome;
    }
    public function setNome($nome){
        $this->nome = $nome;
    }

    public function getDataNascimento(){
        return $this->dataNascimento;
    }
    public function setDataNascimento($dataNascimento){
        $this->dataNascimento = $dataNascimento;
    }
    public function getSenha(){
        return $this->senha;
    }
    public function setSenha($senha){
        $this->senha = $senha;
    }

    public function getCpf()
    {
        return $this->cpf;
    }

    public function setCpf($cpf): void
    {
        $this->cpf = $cpf;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email): void
    {
        $this->email = $email;
    }


}