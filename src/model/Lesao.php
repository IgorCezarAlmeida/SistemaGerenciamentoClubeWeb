<?php
 namespace model;

 use Doctrine\ORM\Mapping as ORM;

 #[ORM\Entity]
 #[ORM\Table(name: 'tb_lesao')]
 class Lesao extends GenericModel {
     #[ORM\Column(type: 'string', length: 255)]
     private $tipoLesao;
     #[ORM\Column(type: 'string', length: 255)]
     private $gravidadeLesao;
     #[ORM\Column(type: 'date')]
     private $inicioLesao;
     #[ORM\Column(type: 'date')]
     private $fimLesao;
     #[ORM\Column(type: 'string', length: 255)]
     private $ObservacaoDP;
     #[ORM\OneToMany(mappedBy: "lesao",targetEntity: Jogador::class,cascade: ["all"], orphanRemoval: true)]
     private $jogador;

     public function getTipoLesao()
     {
         return $this->tipoLesao;
     }

     public function setTipoLesao($tipoLesao): void
     {
         $this->tipoLesao = $tipoLesao;
     }

     public function getInicioLesao()
     {
         return $this->inicioLesao;
     }

     public function setInicioLesao($inicioLesao): void
     {
         $this->inicioLesao = $inicioLesao;
     }

     public function getFimLesao()
     {
         return $this->fimLesao;
     }

     public function setFimLesao($fimLesao): void
     {
         $this->fimLesao = $fimLesao;
     }

     public function getJogador()
     {
         return $this->jogador;
     }

     public function setJogador($jogador): void
     {
         $this->jogador = $jogador;
     }

     public function getObservacaoDP()
     {
         return $this->ObservacaoDP;
     }

     public function setObservacaoDP($ObservacaoDP): void
     {
         $this->ObservacaoDP = $ObservacaoDP;
     }

     public function getGravidadeLesao()
     {
         return $this->gravidadeLesao;
     }

     public function setGravidadeLesao($gravidadeLesao): void
     {
         $this->gravidadeLesao = $gravidadeLesao;
     }



 }