<?php

namespace Config;

class Init
{
    private \PDO $pdo;

    public function __construct()
    {
        $this->createPdo();
    }

    public function resetPdo()
    {
        $this->dropPdo();
        $this->createPdo();
    }

    public function createPdo()
    {
        try {
            $pdo  = new \PDO($_ENV['DB_URL'], $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD']);
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(\PDO::MYSQL_ATTR_INIT_COMMAND, \PDO::ERRMODE_EXCEPTION);

            $dbname = $_ENV['DB_NAME'];
            $pdo->query("CREATE DATABASE IF NOT EXISTS $dbname");
            $pdo->query("use $dbname");

            $pdo->query("CREATE TABLE IF NOT EXISTS storage (
                id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
                name VARCHAR(100),
                total FLOAT,
                ref VARCHAR(100)
            )");

            $this->pdo = $pdo;
        } catch (\PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public function dropPdo()
    {
        $dbname = $_ENV['DB_NAME'];
        $this->pdo->query("DROP DATABASE IF EXISTS $dbname");
    }

    public function getPdo(): \Pdo
    {
        return $this->pdo;
    }
}
