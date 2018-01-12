<?php
        
    class Database {

        private $db = null;

        function __construct() {
            global $database;

            if($this->db != null) {
                return $this->db;
            }

            if(DEBUG) {
                $this->db = new LoggedPDO('mysql:host='.$database['host'].';dbname='.$database['dbname'], $database['user'], $database['pass']);
            } else {
                $this->db = new PDO('mysql:host='.$database['host'].';dbname='.$database['dbname'], $database['user'], $database['pass']);
            }

            $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

            return $this->db;
        }

        function prepare($query) {
            return $this->db->prepare($query);
        }

        function printLog() {
            if(get_class($this->db) === "LoggedPDO")
                $this->db->printLog();
        }

    }
