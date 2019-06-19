<?php

    class MyPDO {
        private $dbServerName;
        private $dbUsername;
        private $dbPassword;
        private $dbName;
        private $charset;

        public function connect() {
            $this->dbServerName = "localhost";
            $this->dbUsername = "root";
            $this->dbPassword = "";
            $this->dbName = "testing";
            $this->charset = 'utf8mb4';

            try {
                $dsn = 'mysql:host=' . $this->dbServerName . ';dbname=' . $this->dbName . ';charset=' . $this->charset;
                $pdo = new PDO($dsn, $this->dbUsername, $this->dbPassword);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                return $pdo;
            } catch (PDOException $e) {
                echo 'Connect failed: ' . $e->getMessage();
            }
        }
    }