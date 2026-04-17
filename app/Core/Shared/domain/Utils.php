<?php

namespace App\Core\Shared\Domain;

use Exception;
use RuntimeException;

class Utils
{


    /**
     * @return string this function generates a UUID version 4 (random) and returns it as a string in the format xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx
     * @throws RuntimeException if random bytes cannot be generated
     */
    static function generateUUIDV4(): string
    {
        // Generar 16 bytes (128 bits) de datos aleatorios
        try {
            $data = random_bytes(16);
        } catch (Exception $e) {
            throw new RuntimeException('Cannot generate random bytes: ' . $e->getMessage());
        }

        // Establecer la versión a 0100 (4) y variante a 10xx (8-b)
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

        // Formatear como UUID (xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx)
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }

}
