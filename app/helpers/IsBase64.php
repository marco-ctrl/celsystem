<?php

namespace App\helpers;

class IsBase64
{
    public static function isBase64Image($data)
    {
        if (!is_string($data)) {
            return false;
        }

        // Quitar espacios y saltos de línea
        $data = trim($data);

        // Detectar si tiene prefijo tipo data URI: data:image/png;base64,xxxxxx
        if (preg_match('/^data:image\/(\w+);base64,/', $data, $type)) {
            $data = substr($data, strpos($data, ',') + 1);
            $imageType = strtolower($type[1]); // png, jpg, jpeg, gif, etc.

            // Validar tipo de imagen permitido
            if (!in_array($imageType, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                return false;
            }
        } else {
            return false; // No tiene formato válido de imagen Base64
        }

        // Largo múltiplo de 4
        if (strlen($data) % 4 !== 0) {
            return false;
        }

        // Caracteres válidos
        if (!preg_match('/^[A-Za-z0-9+\/]+={0,2}$/', $data)) {
            return false;
        }

        // Decodificar
        $decoded = base64_decode($data, true);
        if ($decoded === false) {
            return false;
        }

        // Verificar que realmente sea una imagen
        $finfo = finfo_open();
        $mimeType = finfo_buffer($finfo, $decoded, FILEINFO_MIME_TYPE);
        finfo_close($finfo);

        return strpos($mimeType, 'image/') === 0;
    }
}