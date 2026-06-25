<?php

namespace dao;




use Exception;
use model\Jogador;
use utils\Conexao;

class JogadorDAO extends GenericDAO {
    protected static $modelClass = Jogador::class;

    public static function buscarNome($nome)
    {
        try {
            $em = Conexao::getEntityManager();
            $repository = $em->getRepository(Jogador::class);
            return $repository->findByNome($nome);
        } catch (Exception $ex) {
            throw new Exception("Falha ao jogador jogador pelo nome. " . $ex->getMessage());
        }
    }

    public static function buscarNomeParecido($nome){
        try {
            $em = Conexao::getEntityManager();
            $query = $em->createQuery("SELECT c FROM model\Jogador c WHERE c.nome LIKE :nome");
            $query->setParameter("nome", "%" . $nome . "%");
            return $query->getResult();
        } catch (Exception $ex){
            throw new Exception("Falha ao buscar jogador pelo nome. " . $ex->getMessage());
        }
    }
    public function contarTodos(): int
    {
        try {
            $em = Conexao::getEntityManager();
            $query = $em->createQuery("SELECT COUNT(j.id) FROM model\\Jogador j");
            return (int) $query->getSingleScalarResult();
        } catch (Exception $ex) {
            return 0;
        }
    }

    public function contarLesionados(): int
    {
        try {
            $em = Conexao::getEntityManager();
            $query = $em->createQuery("SELECT COUNT(j.id) FROM model\\Jogador j WHERE j.disponivel = 'lesionado'");
            return (int) $query->getSingleScalarResult();
        } catch (Exception $ex) {
            return 0;
        }
    }

    public function contarDisponiveis(): int
    {
        try {
            $em = Conexao::getEntityManager();
            $query = $em->createQuery("SELECT COUNT(j.id) FROM model\\Jogador j WHERE j.disponivel = 'disponível'");
            return (int) $query->getSingleScalarResult();
        } catch (Exception $ex) {
            return 0;
        }
    }

}