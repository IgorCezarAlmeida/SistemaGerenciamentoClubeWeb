<?php

namespace utils\Facades;

use dao\EscalacaoDAO;
use dao\JogadorDAO;
use model\Escalacao;
use DateTime;
use Exception;

class EscalacaoFacade extends BaseFacade
{

    public static function criar(array $dados): array
    {
        try {
            self::validarDadosEscalacao($dados);

            $escalacao = new Escalacao();
            $escalacao->setDataEscalacao(new DateTime($dados['dataEscalacao']));

            if (!empty($dados['descricao'])) {
                $escalacao->setDescricao($dados['descricao']);
            }

            // Adicionar jogadores
            if (!empty($dados['jogadorIds']) && is_array($dados['jogadorIds'])) {
                foreach ($dados['jogadorIds'] as $jogadorId) {
                    $jogador = JogadorDAO::buscarId($jogadorId);
                    if ($jogador) {
                        $escalacao->adicionarJogador($jogador);
                    }
                }
            }

            EscalacaoDAO::salvar($escalacao);
            self::log("Nova escalação criada (ID: {$escalacao->getId()})");

            return [
                'sucesso' => true,
                'mensagem' => 'Escalação criada com sucesso',
                'dados' => $escalacao
            ];
        } catch (Exception $e) {
            return self::tratarErro($e, 'criar');
        }
    }

    public static function listarTodas(): array
    {
        try {
            $escalacoes = EscalacaoDAO::listar();
            self::log("Listadas " . count($escalacoes ?? []) . " escalações");

            return [
                'sucesso' => true,
                'dados' => $escalacoes ?? [],
                'total' => count($escalacoes ?? [])
            ];
        } catch (Exception $e) {
            return self::tratarErro($e, 'listarTodas');
        }
    }

    public static function buscarPorId(int $id): array
    {
        try {
            if ($id <= 0) {
                throw new Exception("ID inválido");
            }

            $escalacao = EscalacaoDAO::buscarId($id);
            if (!$escalacao) {
                return [
                    'sucesso' => false,
                    'mensagem' => 'Escalação não encontrada',
                    'dados' => null
                ];
            }

            return [
                'sucesso' => true,
                'dados' => $escalacao
            ];
        } catch (Exception $e) {
            return self::tratarErro($e, 'buscarPorId');
        }
    }

    /**
     * Atualiza escalação.
     */
    public static function atualizar(int $id, array $dados): array
    {
        try {
            $escalacao = EscalacaoDAO::buscarId($id);
            if (!$escalacao) {
                return [
                    'sucesso' => false,
                    'mensagem' => 'Escalação não encontrada'
                ];
            }

            self::validarDadosEscalacao($dados, false);

            if (!empty($dados['dataEscalacao'])) {
                $escalacao->setDataEscalacao(new DateTime($dados['dataEscalacao']));
            }

            if (!empty($dados['descricao'])) {
                $escalacao->setDescricao($dados['descricao']);
            }

            EscalacaoDAO::salvar($escalacao);
            self::log("Escalação $id atualizada");

            return [
                'sucesso' => true,
                'mensagem' => 'Escalação atualizada com sucesso',
                'dados' => $escalacao
            ];
        } catch (Exception $e) {
            return self::tratarErro($e, 'atualizar');
        }
    }

    public static function deletar(int $id): array
    {
        try {
            $escalacao = EscalacaoDAO::buscarId($id);
            if (!$escalacao) {
                return [
                    'sucesso' => false,
                    'mensagem' => 'Escalação não encontrada'
                ];
            }

            EscalacaoDAO::deletar($escalacao);
            self::log("Escalação $id deletada");
            AtividadeHelper::registrarAtividade("Escalação removida", 'escalacao');

            return [
                'sucesso' => true,
                'mensagem' => 'Escalação removida com sucesso'
            ];
        } catch (Exception $e) {
            return self::tratarErro($e, 'deletar');
        }
    }

    private static function validarDadosEscalacao(array $dados, bool $obrigatorio = true): void
    {
        if ($obrigatorio) {
            if (empty($dados['dataEscalacao'])) {
                throw new Exception("Data da escalação é obrigatória");
            }
        }

        if (!empty($dados['jogadorIds']) && !is_array($dados['jogadorIds'])) {
            throw new Exception("IDs dos jogadores devem ser um array");
        }
    }
}

