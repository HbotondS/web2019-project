<?php

    class User {
        private $firstname;
        private $lastname;
        private $email;
        private $uid;
        private $pwd;

        public function __construct($firstname, $lastname, $email, $uid, $pwd) {
            $this->firstname = $firstname;
            $this->lastname = $lastname;
            $this->email = $email;
            $this->uid = $uid;
            $this->pwd = $pwd;
        }

        public function getFirstname() {
            return $this->firstname;
        }

        public function setFirstname($firstname) {
            $this->firstname = $firstname;
        }

        public function getLastname() {
            return $this->lastname;
        }

        public function setLastname($lastname) {
            $this->lastname = $lastname;
        }

        public function getEmail() {
            return $this->email;
        }

        public function setEmail($email) {
            $this->email = $email;
        }

        public function getUid() {
            return $this->uid;
        }

        public function setUid($uid) {
            $this->uid = $uid;
        }

        public function getPwd() {
            return $this->pwd;
        }

        public function setPwd($pwd) {
            $this->pwd = $pwd;
        }

    }