<?php

namespace Database;

use PDO;

class DB
{
    private static PDO $pdo;

    public static function init(): void
    {
        self::$pdo = new PDO("mysql:host=".DB_HOST.";port=3399;dbname=".DB_NAME,DB_USER, DB_PASSWORD);
    }

    public static function getConnection(): PDO
    {
        return self::$pdo;
    }
}
