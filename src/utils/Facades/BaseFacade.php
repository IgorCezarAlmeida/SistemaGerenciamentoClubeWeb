<?php

namespace utils\Facades;

use Exception;


abstract class BaseFacade
{

    protected static function log(string $mensagem): void
    {
        error_log("[Façade] " . date('Y-m-d H:i:s') . " - " . $mensagem);
    }

    /**
     * Trata exceções de forma consistente.
     */
    protected static function tratarErro(Exception $e, string $contexto = ""): array
    {
        $mensagem = "Erro" . ($contexto ? " em $contexto" : "") . ": " . $e->getMessage();
        self::log("ERRO - $mensagem");

        return [
            'sucesso' => false,
            'mensagem' => $e->getMessage(),
            'contexto' => $contexto
        ];
    }
}

