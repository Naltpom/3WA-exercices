<?php

namespace Config;

class Init
{
    const DB_USERNAME = 'root';
    const DB_PASSWORD = '';
    const DB_NAME = '3wa_segregation';

    private \PDO $pdo;

    public function __construct()
    {
        $this->createPdo();
        session_start();
    }

    public function resetPdo()
    {
        $this->dropPdo();
        $this->createPdo();
    }

    public function createPdo()
    {
        try {
            $pdo  = new \PDO("mysql:host=localhost;charset=UTF8", self::DB_USERNAME, self::DB_PASSWORD);
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(\PDO::MYSQL_ATTR_INIT_COMMAND, \PDO::ERRMODE_EXCEPTION);

            $dbname = self::DB_NAME;
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
        $dbname = self::DB_NAME;
        $this->pdo->query("DROP DATABASE IF EXISTS $dbname");
    }

    public function getPdo(): \Pdo
    {
        return $this->pdo;
    }
}

//--- CONNEXION BDD




//--- SESSION
session_start();
