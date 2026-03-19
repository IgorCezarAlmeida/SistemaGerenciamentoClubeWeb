<?php

namespace dao;

use Exception;
use model\GenericModel;
use model\Jogador;
use utils\Conexao;

Class GenericDao {
    protected static $modelClass;

    public static function salvar(GenericModel $model){
        try {
            $entityManager = Conexao::getEntityManager();
            $entityManager->beginTransaction();
            $entityManager->persist($model);
            $entityManager->flush();
            $entityManager->commit();
            return $model;
        } catch (Exception $ex){
            $entityManager->rollback();
            throw new Exception( "falha ao salvar os dados" . $ex->getMessage());
        }
    }
    public static function listar(GenericModel $model){
        try {
            $entityManager = Conexao::getEntityManager();
            $repository = $entityManager->getRepository(static::$modelClass);
            return $repository->findAll();
        }catch (Exception $ex){
            throw new Exception( "falha ao listar os dados" . $ex->getMessage());
        }
    }
}
