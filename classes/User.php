<?php
    include_once '../includes/alert.php';

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

        /**
         * Kiolvassa az adatokat ha ismert az id
         */
        function getDataById($id) {
            $idsql = filter_var($id, FILTER_VALIDATE_INT);
            if ($idsql === false) {
                return false;
            } else {
                $sql = "SELECT * FROM users WHERE id = $id";
                return $this->getData($sql);
            }
        }

        /**
         * Kiolvassa az adatokat ha ismert az e-mail cim
         */
        function getDataByEmail($email) {
            $email = filter_var($email, FILTER_VALIDATE_EMAIL);
            if ($email === false) {
                return false;
            }
            $email = $this->db->quote($email, PDO::PARAM_STR);

            $sql = "SELECT * FROM users WHERE email = $email";
            return $this->getData($sql);
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
            try {
                $stmt = $this->db->query($sql);
                if ($a = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    if (!isset($a['id'])) {
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
                    throw new Exception("Nemlétező felhasználó");
                }
            } catch (Exception $e) {
                dbError($e->getMessage());
            }
        }

        /**
         * Uj felhasznalo beszurasa a DB-be
         */
        function insert() {
            if ($this->checkName() == false) {
                alert('Van mar ilyen nev');
                exit();
            } elseif ($this->check_email() == false) {
                alert('Van mar ilyen email');
                exit();
            } elseif ($this->checkUsername() == false) {
                alert('Felhasznalo nev foglalt');
                exit();
            }

            $sql = 'INSERT INTO users (name, email, username, password)' .
                "VALUES (" .
                $this->db->quote($this->name, PDO::PARAM_STR) . ", " .
                $this->db->quote($this->email, PDO::PARAM_STR) . ", " .
                $this->db->quote($this->username, PDO::PARAM_STR) . ", " .
                $this->db->quote($this->password, PDO::PARAM_STR) . " )";

            $no = $this->db->exec($sql);

            if ($no != 1) {
                // ha nem sikerult beiirni
                return false;
            }
            return $this->id;  //siker
        }

        /**
         * Letezo nev ellenorzese
         */
        function checkName() {
            $sql = "SELECT count(*) FROM users WHERE name=" .
                $this->db->quote($this->name, PDO::PARAM_STR);
            $stmt = $this->db->query($sql);
            $no = $stmt->fetch(PDO::FETCH_NUM);

            if ($no[0] >= 1)
                return false;
            else
                return true;
        }

        /**
         * Letezo e-mail ellenorzese
         */
        function check_email() {
            $sql = "SELECT count(*) FROM users WHERE email=" .
                $this->db->quote($this->email, PDO::PARAM_STR);
            $stmt = $this->db->query($sql);
            $r = $stmt->fetch(PDO::FETCH_NUM);

            if ($r[0] >= 1)
                return false;
            else
                return true;
        }

        /**
         * Letezo felhasznalonev ellenorzese
         */
        function checkUsername() {
            $sql = "SELECT count(*) FROM users WHERE username=" .
                $this->db->quote($this->username, PDO::PARAM_STR);
            $stmt = $this->db->query($sql);
            $no = $stmt->fetch(PDO::FETCH_NUM);

            if ($no[0] >= 1)
                return false;
            else
                return true;
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