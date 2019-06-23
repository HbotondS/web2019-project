<?php

    class News {
        // adatbazis kapcsolat
        private $db;

        private $id;
        private $title;
        private $content;
        private $author;
        private $date;

        public function __construct($id = 0, $title = '', $content = '', $author = '') {
            $this->db = (new MyPDO())->connect();
            $this->id = $id;

            if ($this->id) {
                $this->getDataById($this->id);
            } else {
                $this->title = $title;
                $this->content = $content;
                $this->author = $author;
            }
        }

        function __destruct() {

        }

        /**
         * Kiolvassa az adatokat ha ismert az id
         */
        function getDataById($id) {
            $idsql = filter_var($id, FILTER_VALIDATE_INT);
            if ($idsql === false) {
                return false;
            } else {
                $sql = "SELECT * FROM news WHERE id = $id";
                return $this->getData($sql);
            }
        }

        /**
         * Egy lekerdezes alapjan lekeri egy hir adatait
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
                $this->title = $a['title'];
                $this->content = $a['content'];
                $this->author = $a['author'];
                $this->date = $a['date'];
            } else {
                throw new Exception("Nemlétező hír");
            }
        }

        public function getId() {
            return $this->id;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function getTitle() {
            return $this->title;
        }

        public function setTitle($title) {
            $this->title = $title;
        }

        public function getContent() {
            return $this->content;
        }

        public function setContent($content) {
            $this->content = $content;
        }

        public function getAuthor() {
            return $this->author;
        }

        public function setAuthor($author) {
            $this->author = $author;
        }

        public function getDate() {
            return $this->date;
        }

        public function setDate($date) {
            $this->date = $date;
        }

        /**
         * Uj hir beszurasa a DB-be
         */
        function insert() {
            $sql = 'INSERT INTO news (title, content, author)' .
                "VALUES (" .
                $this->db->quote($this->title, PDO::PARAM_STR) . ", " .
                $this->db->quote($this->content, PDO::PARAM_STR) . ", " .
                $this->db->quote($this->author, PDO::PARAM_INT) . ")";

            $no = $this->db->exec($sql);

            if ($no != 1) {
                throw new Exception('Hiba történt a létrehozás során, próbálkozz később.');
            }
        }

        /**
         * Visszateriti az DB-ben talalhato osszes hirt
         */
        static function getAllNews() {
            $db = (new MyPDO())->connect();
            $sql = "SELECT * FROM news ORDER BY date DESC;";
            $stmt = $db->query($sql);
            return $stmt->fetchAll();
        }
    }