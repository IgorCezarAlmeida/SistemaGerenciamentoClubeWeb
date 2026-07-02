<?php

namespace utils;

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use PDO;

class Conexao {
    private static $entityManager;

    private static function env(string $key): ?string {
        return $_ENV[$key] ?? getenv($key) ?: null;
    }

    private static function validateEnvVars(): void {
        $required = ['DB_DRIVER', 'DB_HOST', 'DB_PORT', 'DB_NAME', 'DB_USER', 'DB_PASSWORD'];
        $missing = [];
        
        foreach ($required as $var) {
            if (!self::env($var)) {
                $missing[] = $var;
            }
        }
        
        if (!empty($missing)) {
            throw new \Exception(
                "Variáveis de ambiente obrigatórias não configuradas: " . implode(', ', $missing) . 
                "\n\nNo Render.com, configure-as em: Web Service > Environment > Add Environment Variable"
            );
        }
    }

    public static function getEntityManager() {
        if (self::$entityManager === null) {
            self::validateEnvVars();
            
            $config = ORMSetup::createAttributeMetadataConfiguration(
                paths: [realpath(__DIR__ . '/../model')],
                isDevMode: false,
            );

            $connection = DriverManager::getConnection([
                'driver' => self::env('DB_DRIVER'),
                'host' => self::env('DB_HOST'),
                'port' => self::env('DB_PORT'),
                'dbname' => self::env('DB_NAME'),
                'user' => self::env('DB_USER'),
                'password' => self::env('DB_PASSWORD'),
                'driverOptions' => [
                    PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false,
                    PDO::MYSQL_ATTR_SSL_CA => true,
                ],
            ], $config);

            self::$entityManager = new EntityManager($connection, $config);
        }
        return self::$entityManager;
    }
}
