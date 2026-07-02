<?php

namespace utils;

class AtividadeHelper
{
    const MAX_ATIVIDADES = 10;

    public static function registrarAtividade(string $descricao, string $tipo = 'geral'): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        if (!isset($_SESSION['atividades'])) {
            $_SESSION['atividades'] = [];
        }

        $atividade = [
            'descricao' => $descricao,
            'tipo' => $tipo,
            'data' => new \DateTime(),
            'timestamp' => time()
        ];

        // Adiciona no início do array
        array_unshift($_SESSION['atividades'], $atividade);

        // Mantém apenas as últimas N atividades
        if (count($_SESSION['atividades']) > self::MAX_ATIVIDADES) {
            $_SESSION['atividades'] = array_slice($_SESSION['atividades'], 0, self::MAX_ATIVIDADES);
        }
    }

    public static function obterAtividades(int $limite = 5): array
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        $atividades = $_SESSION['atividades'] ?? [];
        return array_slice($atividades, 0, $limite);
    }

    public static function limparAtividades(): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        $_SESSION['atividades'] = [];
    }

    public static function formatarData(\DateTime $data): string
    {
        $agora = new \DateTime();
        $diff = $agora->diff($data);

        if ($diff->days == 0) {
            if ($diff->h == 0) {
                if ($diff->i == 0) {
                    return 'Agora';
                }
                return 'Há ' . $diff->i . ' minuto(s)';
            }
            return 'Há ' . $diff->h . ' hora(s)';
        } elseif ($diff->days == 1) {
            return 'Ontem às ' . $data->format('H:i');
        } else {
            return $data->format('d/m/Y H:i');
        }
    }
}

