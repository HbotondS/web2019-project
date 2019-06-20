<?php

    class User {
        // adatbazis kapcsolat
        private $db;

        private $id;
        private $name;
        private $email;
        private $username;
        private $password;


        public function __construct($id = 0, $name = '', $email = '', $username = '', $password = '') {
            $this->db = (new MyPDO())->connect();
            $this->id = $id;

            if ($this->id) {
                $this->getDataById($this->id);
            } else {
                $this->name = $name;
                $this->email = $email;
                $this->username = $username;
                $this->password = md5($password);
            }
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

        // kiolvassa az adatokat ha ismert az id
        private function getDataById($id) {
            $idsql = filter_var($id, FILTER_VALIDATE_INT);
            if ($idsql === false) {
                return false;
            } else {
                $sql = "SELECT * FROM users WHERE id = $id";
                try {
                    $this->getData($sql);
                } catch (Exception $e) {
                    $msg = $e->getMessage();
                    echo "<script src='../includes/errorHandler.js'></script>";
                    echo "<script>dbError('$msg')</script>";
                }
            }
        }

        /**
         * Egy lekerdezes alapjan lekeri egy felhasznalo adatait
         *
         * @param string, az sql lekerdezes
         * @return bool, igazat terit vissza ha a lekerdezes sikeres
         *         maskepp egy Exception-t dob
         * @throws Exception, mikor valamilyen adatbazis hiba van
         */
        private function getData($sql) {
            $stmt = $this->db->query($sql);
            if ($a = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if(!isset( $a['id'])){
                    throw new Exception("Adatbázis hiba, hiányzó mező");
                }
                $this->id = $a['id'];
                $this->name = $a['name'];
                $this->email = $a['email'];
                $this->username = $a['username'];
                $this->password = $a['password'];
                return true;
            } else {
                // nincs ilyen felhasznalo
                throw new Exception("Nemlétező felhasznháló");
            }
        }

        public function __toString() {
            $s = '------------------------<br>';
            $s .= "Id: " . $this->id . '<br>' .
                "Name: " . $this->name . "<br>" .
                "Email: " . $this->email . "<br>" .
                "Username: " . $this->username;
            $s .= '<br>------------------------<br>';
            return $s;
        }
    }