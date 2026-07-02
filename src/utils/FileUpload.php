<?php

namespace utils;

use Cloudinary\Cloudinary;
use Exception;

class FileUpload{
    private static $storage;

    private static function env(string $key): ?string {
        return $_ENV[$key] ?? getenv($key) ?: null;
    }

    private static function getStorage(){
        if (self::$storage === null) {
            $cloudinaryUrl = self::env('CLOUDINARY_URL');
            if (!$cloudinaryUrl) {
                throw new Exception(
                    "Variável CLOUDINARY_URL não configurada.\n" .
                    "No Render.com, adicione em: Web Service > Environment > Add Environment Variable"
                );
            }
            self::$storage = new Cloudinary($cloudinaryUrl);
        }
        return self::$storage;
    }

    public static function uploadImagem($pasta, $imagem, $idPublico){
        try {
            $uploadAPI = self::getStorage()->uploadApi();

            $result = $uploadAPI->upload($imagem, [
                'folder' => $pasta,
                'public_id' => $idPublico,
                'overwrite' => true,
                'resource_type' => 'image'
            ]);

            return $result;
        } catch (Exception $e) {
            throw new Exception("Erro no upload da imagem: " . $e->getMessage());
        }
    }

    public static function deletarImagem($pasta, $publicUrl){
        try {
            $uploadAPI = self::getStorage()->uploadApi();
            $publicId = $pasta . "/" . pathinfo($publicUrl, PATHINFO_FILENAME);
            $result = $uploadAPI->destroy($publicId, ['resource_type' => 'image']);
            return $result;
        } catch (Exception $e) {
            throw new Exception("Erro ao deletar a imagem: " . $e->getMessage());
        }
    }
}