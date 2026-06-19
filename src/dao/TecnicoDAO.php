<?php
namespace dao;

use Exception;
use model\Tecnico;
use utils\Conexao;


class TecnicoDAO extends GenericDAO{
    protected static $modelClass = Tecnico::class;

    public static function buscarEmail(string $email) {
        try {
            $em = Conexao::getEntityManager();
            $repository = $em->getRepository(Tecnico::class);
            return $repository->findOneBy(['email' => $email]); // ✅
        } catch (Exception $ex) {
            throw new Exception("Falha ao procurar Técnico pelo email. " . $ex->getMessage());
        }
    }

    public static function buscarCpf(string $cpf) {
        try {
            $em = Conexao::getEntityManager();
            $repository = $em->getRepository(Tecnico::class);
            return $repository->findOneBy(['cpf' => $cpf]); // ✅
        } catch (Exception $ex) {
            throw new Exception("Falha ao procurar Técnico pelo CPF. " . $ex->getMessage());
        }
    }
}