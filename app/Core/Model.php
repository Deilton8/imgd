<?php
namespace App\Core;

use PDO;
use App\Core\Config;

class Model
{
    protected $db;

    public function __construct()
    {
        $dsn = "mysql:host=" . Config::get("db_host") .
            ";port=" . Config::get("db_port") .
            ";dbname=" . Config::get("db_name");

        $this->db = new PDO(
            $dsn,
            Config::get("db_user"),
            Config::get("db_pass")
        );

        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
}