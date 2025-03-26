<?php

namespace App\Config;

class Database {
    private static \PDO $conn = null;

    public static function getConnection(): \PDO {
        if (!self::$conn) {
            self::$conn = new PDO('mysql:host=mysql;dbname=facebook', 'user', 'password');
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$conn->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
        }

        echo "Connected to database";

        return self::$conn;
    }
}
