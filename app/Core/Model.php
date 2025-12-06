<?php
namespace App\Core;

use PDO;
use App\Core\Config;

class Model
{
    protected $database;

    public function __construct()
    {
        $this->database = $this->createDatabaseConnection();
        $this->configureDatabaseConnection();
    }

    /**
     * Cria a conexão com o banco de dados
     */
    private function createDatabaseConnection()
    {
        $dsn = $this->buildDsn();

        return new PDO(
            $dsn,
            Config::get("db_user"),
            Config::get("db_pass")
        );
    }

    /**
     * Constrói a string DSN para conexão
     */
    private function buildDsn()
    {
        return sprintf(
            "mysql:host=%s;port=%s;dbname=%s",
            Config::get("db_host"),
            Config::get("db_port"),
            Config::get("db_name")
        );
    }

    /**
     * Configura atributos da conexão PDO
     */
    private function configureDatabaseConnection()
    {
        $this->database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
}