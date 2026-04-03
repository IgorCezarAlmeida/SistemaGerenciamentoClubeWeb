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
            throw new Exception("Falha ao jogador cliente pelo nome. " . $ex->getMessage());
        }
    }

    public static function buscarNomeParecido($nome){
        try {
            $em = Conexao::getEntityManager();
            $query = $em->createQuery("SELECT c FROM model\Cliente c WHERE c.nome LIKE :nome");
            $query->setParameter("nome", "%" . $nome . "%");
            return $query->getResult();
        } catch (Exception $ex){
            throw new Exception("Falha ao buscar jogador pelo nome. " . $ex->getMessage());
        }
    }

}