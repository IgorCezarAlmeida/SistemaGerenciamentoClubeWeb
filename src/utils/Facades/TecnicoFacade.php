<?php

namespace utils\Facades;

use dao\TecnicoDAO;
use model\Tecnico;
use DateTime;
use Exception;

class TecnicoFacade extends BaseFacade
{
    public static function autenticar(string $email, string $senha): array
    {
        try {
            if (empty($email) || empty($senha)) {
                return [
                    'sucesso' => false,
                    'mensagem' => 'E-mail e senha são obrigatórios'
                ];
            }

            $tecnico = TecnicoDAO::buscarEmail($email);
            if (!$tecnico) {
                self::log("Tentativa de login falhou: usuário $email não encontrado");
                return [
                    'sucesso' => false,
                    'mensagem' => 'Usuário não encontrado'
                ];
            }

            if (!password_verify($senha, $tecnico->getSenha())) {
                self::log("Tentativa de login falhou: senha inválida para $email");
                return [
                    'sucesso' => false,
                    'mensagem' => 'Senha inválida'
                ];
            }

            self::log("Login bem-sucedido: {$tecnico->getNome()} (ID: {$tecnico->getId()})");

            return [
                'sucesso' => true,
                'mensagem' => 'Login realizado com sucesso',
                'dados' => [
                    'id' => $tecnico->getId(),
                    'nome' => $tecnico->getNome(),
                    'email' => $tecnico->getEmail(),
                    'cpf' => $tecnico->getCpf()
                ]
            ];
        } catch (Exception $e) {
            return self::tratarErro($e, 'autenticar');
        }
    }

    /**
     * Cria novo técnico com validações.
     */
    public static function criar(array $dados): array
    {
        try {
            self::validarDadosTecnico($dados);

            // Verificar se e-mail já existe
            $existente = TecnicoDAO::buscarEmail($dados['email']);
            if ($existente) {
                return [
                    'sucesso' => false,
                    'mensagem' => 'E-mail já cadastrado'
                ];
            }

            // Verificar se CPF já existe
            $cpfLimpo = preg_replace('/\D/', '', $dados['cpf']);
            $existenteCpf = TecnicoDAO::buscarCpf($cpfLimpo);
            if ($existenteCpf) {
                return [
                    'sucesso' => false,
                    'mensagem' => 'CPF já cadastrado'
                ];
            }

            $tecnico = new Tecnico();
            $tecnico->setNome($dados['nome']);
            $tecnico->setCpf($cpfLimpo);
            $tecnico->setEmail($dados['email']);
            $tecnico->setDataNascimento(new DateTime($dados['dataNascimento']));
            $tecnico->setSenha(password_hash($dados['senha'], PASSWORD_DEFAULT));

            TecnicoDAO::salvar($tecnico);
            self::log("Novo técnico criado: {$tecnico->getNome()} (ID: {$tecnico->getId()})");

            return [
                'sucesso' => true,
                'mensagem' => 'Técnico criado com sucesso',
                'dados' => $tecnico
            ];
        } catch (Exception $e) {
            return self::tratarErro($e, 'criar');
        }
    }

    /**
     * Atualiza técnico existente.
     */
    public static function atualizar(int $id, array $dados): array
    {
        try {
            $tecnico = TecnicoDAO::buscarId($id);
            if (!$tecnico) {
                return [
                    'sucesso' => false,
                    'mensagem' => 'Técnico não encontrado'
                ];
            }

            self::validarDadosTecnico($dados, false);

            if (!empty($dados['nome'])) $tecnico->setNome($dados['nome']);
            if (!empty($dados['cpf'])) {
                $cpfLimpo = preg_replace('/\D/', '', $dados['cpf']);
                $tecnico->setCpf($cpfLimpo);
            }
            if (!empty($dados['email'])) $tecnico->setEmail($dados['email']);
            if (!empty($dados['dataNascimento'])) $tecnico->setDataNascimento(new DateTime($dados['dataNascimento']));
            if (!empty($dados['senha'])) {
                if (strlen($dados['senha']) < 6) {
                    throw new Exception("Senha deve ter no mínimo 6 caracteres");
                }
                $tecnico->setSenha(password_hash($dados['senha'], PASSWORD_DEFAULT));
            }

            TecnicoDAO::salvar($tecnico);
            self::log("Técnico $id atualizado");

            return [
                'sucesso' => true,
                'mensagem' => 'Técnico atualizado com sucesso',
                'dados' => $tecnico
            ];
        } catch (Exception $e) {
            return self::tratarErro($e, 'atualizar');
        }
    }

    /**
     * Lista todos os técnicos.
     */
    public static function listarTodos(): array
    {
        try {
            $tecnicos = TecnicoDAO::listar();
            self::log("Listados " . count($tecnicos ?? []) . " técnicos");

            return [
                'sucesso' => true,
                'dados' => $tecnicos ?? [],
                'total' => count($tecnicos ?? [])
            ];
        } catch (Exception $e) {
            return self::tratarErro($e, 'listarTodos');
        }
    }

    /**
     * Busca técnico por ID.
     */
    public static function buscarPorId(int $id): array
    {
        try {
            if ($id <= 0) {
                throw new Exception("ID inválido");
            }

            $tecnico = TecnicoDAO::buscarId($id);
            if (!$tecnico) {
                return [
                    'sucesso' => false,
                    'mensagem' => 'Técnico não encontrado',
                    'dados' => null
                ];
            }

            return [
                'sucesso' => true,
                'dados' => $tecnico
            ];
        } catch (Exception $e) {
            return self::tratarErro($e, 'buscarPorId');
        }
    }

    /**
     * Deleta técnico.
     */
    public static function deletar(int $id): array
    {
        try {
            $tecnico = TecnicoDAO::buscarId($id);
            if (!$tecnico) {
                return [
                    'sucesso' => false,
                    'mensagem' => 'Técnico não encontrado'
                ];
            }

            TecnicoDAO::deletar($tecnico);
            self::log("Técnico $id deletado");

            return [
                'sucesso' => true,
                'mensagem' => 'Técnico removido com sucesso'
            ];
        } catch (Exception $e) {
            return self::tratarErro($e, 'deletar');
        }
    }

    /**
     * Valida dados do técnico.
     */
    private static function validarDadosTecnico(array $dados, bool $obrigatorio = true): void
    {
        if ($obrigatorio) {
            if (empty($dados['nome'])) {
                throw new Exception("Nome é obrigatório");
            }
            if (empty($dados['cpf'])) {
                throw new Exception("CPF é obrigatório");
            }
            if (empty($dados['email'])) {
                throw new Exception("E-mail é obrigatório");
            }
            if (empty($dados['dataNascimento'])) {
                throw new Exception("Data de nascimento é obrigatória");
            }
            if (empty($dados['senha'])) {
                throw new Exception("Senha é obrigatória");
            }
        }

        if (!empty($dados['cpf'])) {
            $cpfLimpo = preg_replace('/\D/', '', $dados['cpf']);
            if (strlen($cpfLimpo) !== 11) {
                throw new Exception("CPF inválido");
            }
        }

        if (!empty($dados['email']) && !filter_var($dados['email'], FILTER_VALIDATE_EMAIL)) {
            throw new Exception("E-mail inválido");
        }

        if (!empty($dados['senha']) && strlen($dados['senha']) < 6) {
            throw new Exception("Senha deve ter no mínimo 6 caracteres");
        }
    }
}

