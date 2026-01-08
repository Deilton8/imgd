<?php
namespace App\Core;

class Config
{
    private const SETTINGS = [
        "db_host" => "localhost",
        "db_port" => "3307",
        "db_name" => "igreja",
        "db_user" => "root",
        "db_pass" => ""
    ];

    /**
     * Obtém uma configuração pelo nome
     */
    public static function get($key)
    {
        return self::SETTINGS[$key] ?? null;
    }
}