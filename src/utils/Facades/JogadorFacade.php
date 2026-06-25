<?php

namespace utils\Facades;

use dao\JogadorDAO;
use model\Jogador;
use DateTime;
use Exception;


class JogadorFacade extends BaseFacade
{

    public static function listarTodos(): array
    {
        try {
            $jogadores = JogadorDAO::listar();
            self::log("Listados " . count($jogadores ?? []) . " jogadores");

            return [
                'sucesso' => true,
                'dados' => $jogadores ?? [],
                'total' => count($jogadores ?? [])
            ];
        } catch (Exception $e) {
            return self::tratarErro($e, 'listarTodos');
        }
    }

    /**
     * Busca jogador por ID.
     */
    public static function buscarPorId(int $id): array
    {
        try {
            if ($id <= 0) {
                throw new Exception("ID inválido");
            }

            $jogador = JogadorDAO::buscarId($id);
            if (!$jogador) {
                return [
                    'sucesso' => false,
                    'mensagem' => 'Jogador não encontrado',
                    'dados' => null
                ];
            }

            self::log("Jogador $id buscado com sucesso");
            return [
                'sucesso' => true,
                'dados' => $jogador
            ];
        } catch (Exception $e) {
            return self::tratarErro($e, 'buscarPorId');
        }
    }

    /**
     * Cria novo jogador com validações.
     */
    public static function criar(array $dados): array
    {
        try {
            // Validações
            self::validarDadosJogador($dados);

            $jogador = new Jogador();
            $jogador->setNome($dados['nome']);
            $jogador->setNumeroCamisa((int)$dados['numeroCamisa']);
            $jogador->setPesoKG((int)$dados['pesoKG']);
            $jogador->setAlturaCM((float)$dados['alturaCM']);
            $jogador->setDataNascimento(new DateTime($dados['data_nascimento']));
            $jogador->setDisponivel($dados['disponivel'] ?? 'sim');
            $jogador->setDescricao($dados['descricao'] ?? '');
            $jogador->setPernaDominante($dados['pernaDominante'] ?? 'direita');
            $jogador->setPosicao($dados['posicao'] ?? 'meia');

            if (!empty($dados['urlFotoJogador'])) {
                $jogador->setUrlFotoJogador($dados['urlFotoJogador']);
            }

            JogadorDAO::salvar($jogador);
            self::log("Novo jogador criado: {$jogador->getNome()} (ID: {$jogador->getId()})");
            AtividadeHelper::registrarAtividade("Novo jogador cadastrado: " . $jogador->getNome(), 'jogador');

            return [
                'sucesso' => true,
                'mensagem' => 'Jogador criado com sucesso',
                'dados' => $jogador
            ];
        } catch (Exception $e) {
            return self::tratarErro($e, 'criar');
        }
    }

    /**
     * Atualiza jogador existente.
     */
    public static function atualizar(int $id, array $dados): array
    {
        try {
            $jogador = JogadorDAO::buscarId($id);
            if (!$jogador) {
                return [
                    'sucesso' => false,
                    'mensagem' => 'Jogador não encontrado'
                ];
            }

            self::validarDadosJogador($dados, false);

            // Atualizar apenas campos preenchidos
            if (!empty($dados['nome'])) $jogador->setNome($dados['nome']);
            if (!empty($dados['numeroCamisa'])) $jogador->setNumeroCamisa((int)$dados['numeroCamisa']);
            if (!empty($dados['pesoKG'])) $jogador->setPesoKG((int)$dados['pesoKG']);
            if (!empty($dados['alturaCM'])) $jogador->setAlturaCM((float)$dados['alturaCM']);
            if (!empty($dados['data_nascimento'])) $jogador->setDataNascimento(new DateTime($dados['data_nascimento']));
            if (isset($dados['disponivel'])) $jogador->setDisponivel($dados['disponivel']);
            if (!empty($dados['descricao'])) $jogador->setDescricao($dados['descricao']);
            if (!empty($dados['pernaDominante'])) $jogador->setPernaDominante($dados['pernaDominante']);
            if (!empty($dados['posicao'])) $jogador->setPosicao($dados['posicao']);
            if (!empty($dados['urlFotoJogador'])) $jogador->setUrlFotoJogador($dados['urlFotoJogador']);

            JogadorDAO::salvar($jogador);
            self::log("Jogador $id atualizado");
            AtividadeHelper::registrarAtividade("Jogador atualizado: " . $jogador->getNome(), 'jogador');

            return [
                'sucesso' => true,
                'mensagem' => 'Jogador atualizado com sucesso',
                'dados' => $jogador
            ];
        } catch (Exception $e) {
            return self::tratarErro($e, 'atualizar');
        }
    }

    /**
     * Deleta jogador.
     */
    public static function deletar(int $id): array
    {
        try {
            $jogador = JogadorDAO::buscarId($id);
            if (!$jogador) {
                return [
                    'sucesso' => false,
                    'mensagem' => 'Jogador não encontrado'
                ];
            }

            JogadorDAO::deletar($jogador);
            self::log("Jogador $id deletado");
            AtividadeHelper::registrarAtividade("Jogador removido: " . $jogador->getNome(), 'jogador');

            return [
                'sucesso' => true,
                'mensagem' => 'Jogador removido com sucesso'
            ];
        } catch (Exception $e) {
            return self::tratarErro($e, 'deletar');
        }
    }

    /**
     * Lista jogadores disponíveis.
     */
    public static function listarDisponiveis(): array
    {
        try {
            $todos = JogadorDAO::listar();
            $disponiveis = array_filter($todos ?? [], fn($j) => strtolower($j->getDisponivel()) === 'sim');

            return [
                'sucesso' => true,
                'dados' => array_values($disponiveis),
                'total' => count($disponiveis)
            ];
        } catch (Exception $e) {
            return self::tratarErro($e, 'listarDisponiveis');
        }
    }

    /**
     * Valida dados do jogador.
     */
    private static function validarDadosJogador(array $dados, bool $obrigatorio = true): void
    {
        if ($obrigatorio) {
            if (empty($dados['nome'])) {
                throw new Exception("Nome do jogador é obrigatório");
            }
            if (empty($dados['numeroCamisa'])) {
                throw new Exception("Número da camisa é obrigatório");
            }
            if (empty($dados['pesoKG']) || !is_numeric($dados['pesoKG'])) {
                throw new Exception("Peso deve ser um número válido");
            }
            if (empty($dados['alturaCM']) || !is_numeric($dados['alturaCM'])) {
                throw new Exception("Altura deve ser um número válido");
            }
            if (empty($dados['data_nascimento'])) {
                throw new Exception("Data de nascimento é obrigatória");
            }
        }

        // Validações opcionais
        if (!empty($dados['numeroCamisa']) && (!is_numeric($dados['numeroCamisa']) || $dados['numeroCamisa'] < 1 || $dados['numeroCamisa'] > 99)) {
            throw new Exception("Número da camisa deve estar entre 1 e 99");
        }

        if (!empty($dados['pesoKG']) && ($dados['pesoKG'] < 30 || $dados['pesoKG'] > 150)) {
            throw new Exception("Peso deve estar entre 30kg e 150kg");
        }

        if (!empty($dados['alturaCM']) && ($dados['alturaCM'] < 140 || $dados['alturaCM'] > 220)) {
            throw new Exception("Altura deve estar entre 140cm e 220cm");
        }
    }
}

