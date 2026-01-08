<?php
namespace App\Core;

class Config
{
    private const SETTINGS = [
        "db_host" => "localhost",
        "db_port" => "3307",
        "db_name" => "imgdorgm_igreja",
        "db_user" => "imgdorgm_imgd",
        "db_pass" => "Ministerio@2007"
    ];

    /**
     * Obtém uma configuração pelo nome
     */
    public static function get($key)
    {
        return self::SETTINGS[$key] ?? null;
    }
}
