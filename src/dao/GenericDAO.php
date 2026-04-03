<?php

namespace dao;

use Exception;
use model\GenericModel;
use model\Jogador;
use utils\Conexao;

Class GenericDAO {
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
    public static function listar(){
        try {
            $entityManager = Conexao::getEntityManager();
            $repository = $entityManager->getRepository(static::$modelClass);
            return $repository->findAll();
        }catch (Exception $ex){
            throw new Exception( "falha ao listar os dados" . $ex->getMessage());
        }
    }
    public static function deletar(GenericModel $model){
        try {
            $em = Conexao::getEntityManager();
            $em->beginTransaction();
            $em->remove($model);
            $em->flush();
            $em->commit();
        } catch (Exception $ex){
            $em->rollback();
            throw new Exception("Falha ao deletar os dados." . $ex->getMessage());
        }
    }
    public static function buscarId(GenericModel $model){
        try {
            $em = Conexao::getEntityManager();
            $repository = $em->getRepository(static::$modelClass);
            return $repository->find($model->getId());
        } catch (Exception $ex){
            throw new Exception( "Falha ao buscar pelo ID." . $ex->getMessage());
        }
    }
}
