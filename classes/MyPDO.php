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
            $this->dbName = "felveteli";
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

        public function getAllUser() {
            $db = $this->connect();
            $sql = "SELECT * FROM users WHERE role = 'user'";
            $stmt = $db->query($sql);
            $users = array();
            while ($a = $stmt->fetch()) {
                $user = new User();
                $user->setId($a['id']);
                $user->setName($a['name']);
                $user->setEmail($a['email']);
                $user->setUsername($a['username']);
                $user->setPassword($a['password']);
                $user->setRole($a['role']);

                array_push($users, $user);
            }

            return $users;
        }
    }