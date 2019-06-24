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
        private $role;


        public function __construct($id = 0, $name = '', $email = '', $username = '', $password = '', $role = '') {
            $this->db = (new MyPDO())->connect();
            $this->id = $id;

            if ($this->id) {
                $this->getDataById($this->id);
            } else {
                $this->name = $name;
                $this->email = $email;
                $this->username = $username;
                $this->password = md5($password);
                $this->role = $role;
            }
        }

        function __destruct() {

        }

        public function getId() {
            return $this->id;
        }

        public function setId($id) {
            $this->id = $id;
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

        public function getRole() {
            return $this->role;
        }

        public function setRole($role) {
            $this->role = $role;
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
         * Kiolvassa az adatokat ha ismert az felhasznalonev
         */
        function getDataByUsername($username) {
            $username = $this->db->quote($username, PDO::PARAM_STR);

            $sql = "SELECT * FROM users WHERE username = $username";
            return $this->getData($sql);
        }

        /**
         * Egy lekerdezes alapjan lekeri egy felhasznalo adatait
         *
         * @param string, az sql lekerdezes
         * @throws Exception, mikor valamilyen adatbazis hiba van
         */
        private function getData($sql) {
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
                $this->role = $a['role'];
            } else {
                throw new Exception("Nemlétező felhasználó");
            }
        }

        /**
         * Nev felulirasa feltetelezzuk a  belso adatok be vannak allitva
         */
        function updateName() {
            if ($this->checkName() == false) {
                throw new Exception("Van már ilyen nevű felhasználó", UserUpdateErrorCode::existingUser);
            } else {
                $sql = "UPDATE users SET name = " .
                    $this->db->quote($this->name, PDO::PARAM_STR) .
                    'WHERE id=' . $this->id;
                $no = $this->db->exec($sql);
                if ($no == 1) //sikeres
                    return true;
                else
                    return false;
            }
        }

        /**
         * Email felulirasa,
         * feltetelezzuk a  belso adatok be vannak allitva
         */
        function updateEmail() {
            if ($this->check_email() == false) {
                throw new Exception('Van már ilyen e-mail', UserUpdateErrorCode::existingEmail);
            } else {
                $sql = "UPDATE users SET email = " .
                    $this->db->quote($this->email, PDO::PARAM_STR) .
                    'WHERE id=' . $this->id;
                $no = $this->db->exec($sql);
                if ($no == 1) //sikeres
                    return true;
                else
                    return false;
            }
        }

        /**
         * Felhasznalonev felulirasa,
         * feltetelezzuk a  belso adatok be vannak allitva
         */
        function updateUsername() {
            if ($this->checkUsername() == false) {
                throw new Exception('Felhasználónév foglalt', UserUpdateErrorCode::existingUsername);
            } else {
                $sql = "UPDATE users SET username = " .
                    $this->db->quote($this->username, PDO::PARAM_STR) .
                    'WHERE id=' . $this->id;
                $no = $this->db->exec($sql);
                if ($no == 1) //sikeres
                    return true;
                else
                    return false;
            }
        }

        /**
         * Dokumentum hozzaadasa a userhez
         */
        function attachDoc($name, $mime, $doc) {
            $sql = "INSERT INTO docs (userId, doc, name,  mime) VALUES (?,?,?,?);";
            $sql = $this->db->prepare($sql);
            $sql->bindParam(1, $this->id);
            $sql->bindParam(2, $doc);
            $sql->bindParam(3, $name);
            $sql->bindParam(4, $mime);
            $no = $sql->execute();
            if ($no == 1) {//sikeres
                return true;
            } else {
                return false;
            }
        }

        /**
         * Torli a parameterben atadott dokumentumot
         */
        function delDoc($doc) {
            $sql = "DELETE FROM docs WHERE userid=? and id=?;";
            $sql = $this->db->prepare($sql);
            $sql->bindParam(1, $this->id);
            $sql->bindParam(2, $doc);
            $no = $sql->execute();
            if ($no == 1) {//sikeres
                return true;
            } else {
                return false;
            }
        }

        /**
         * Osszes dokumentum visszateritese, ami az adott felhasznalohoz tartozik
         */
        function getAllDoc() {
            $sql = "SELECT * FROM docs WHERE userid = $this->id;";
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll();
        }

        /**
         * Uj felhasznalo beszurasa a DB-be
         */
        function insert() {
            if ($this->checkName() == false) {
                throw new Exception("Van már ilyen nevű felhasználó", UserUpdateErrorCode::existingUser);
            } elseif ($this->check_email() == false) {
                throw new Exception('Van már ilyen e-mail', UserUpdateErrorCode::existingEmail);
            } elseif ($this->checkUsername() == false) {
                throw new Exception('Felhasználónév foglalt', UserUpdateErrorCode::existingUsername);
            }

            $sql = 'INSERT INTO users (name, email, username, password, role)' .
                "VALUES (" .
                $this->db->quote($this->name, PDO::PARAM_STR) . ", " .
                $this->db->quote($this->email, PDO::PARAM_STR) . ", " .
                $this->db->quote($this->username, PDO::PARAM_STR) . ", " .
                $this->db->quote($this->password, PDO::PARAM_STR) . ", 'user')";

            $no = $this->db->exec($sql);

            if ($no != 1) {
                // ha nem sikerult beiirni
                return false;
            }
            return $this->id;  //siker
        }

        /**
         * Torli a felhasznalot a DB-bol
         */
        function delete() {

            $sql = 'DELETE FROM users WHERE id=' . $this->id;

            $no = $this->db->exec($sql);
            if ($no == 1) //sikeres
                return true;
            else
                return false;
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

        /**
         * Megadott jelszo ellenorzese
         */
        function checkPwd($pwd) {
            $pwd = filter_var($pwd, FILTER_SANITIZE_STRING);
            $pwd = md5($pwd);

            return $this->password === $pwd;
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