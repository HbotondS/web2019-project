<?php

    class User {
        private $name;
        private $email;
        private $username;
        private $password;


        public function __construct($name, $email, $username, $password) {
            $this->name = $name;
            $this->email = $email;
            $this->username = $username;
            $this->password = $password;
        }

        function __destruct() {

        }

        public function getName() {
            return $this->name;
        }

        public function setName($name) {
            $this->name = $name;
        }

        public function getEmail() {
            return $this->email;
        }

        public function setEmail($email) {
            $this->email = $email;
        }

        public function getUsername() {
            return $this->username;
        }

        public function setUsername($username) {
            $this->username = $username;
        }

        public function getPassword() {
            return $this->password;
        }

        public function setPassword($password) {
            $this->password = $password;
        }
    }