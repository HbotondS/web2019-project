<?php

    class User {
        // adatbazis kapcsolat
        private $db;

        private $id;
        private $firstname;
        private $lastname;
        private $email;
        private $uid;
        private $pwd;

        public function __construct($id = 0, $firstname = '', $lastname = '', $email = '', $uid = '', $pwd = '') {
            $this->db = (new MyPDO())->connect();
            $this->id = $id;

            if ($this->id) {
                $this->getDataById($this->id);
            } else {
                $this->firstname = $firstname;
                $this->lastname = $lastname;
                $this->email = $email;
                $this->uid = $uid;
                $this->pwd = md5($pwd);
            }
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

        // kiolvassa az adatokat ha ismert az id
        private function getDataById($id) {
            $idsql = filter_var($id, FILTER_VALIDATE_INT);
            if ($idsql === false) {
                return false;
            } else {
                $sql = "SELECT * FROM users WHERE id = $id";

                $this->getData($sql);
            }
        }

        // egy lekerdezes alapjan lekeri egy felhasznalo adatait
        private function getData($sql) {
            $stmt = $this->db->query($sql);
            $a = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($a) {
                if(!isset( $a['id'])){
                    throw new Exception("Adatbázis hiba, hiányzó mező");
                }
                $this->id = $a['id'];
                $this->firstname = $a['firstname'];
                $this->lastname = $a['lastname'];
                $this->email = $a['email'];
                $this->uid = $a['username'];
                $this->pwd = $a['password'];

                return true;
            } else {
                // nincs ilyen felhasznalo
                return false;
            }
        }

        public function __toString() {
            $s = '------------------------<br>';
            $s .= "Id: " . $this->id . '<br>' .
                "Firstname: " . $this->firstname . "<br>" .
                "Lastname: " . $this->lastname . "<br>" .
                "Email: " . $this->email . "<br>" .
                "Uid: " . $this->uid;
            $s .= '<br>------------------------<br>';
            return $s;
        }


    }