<?php

    class Database {

        private $dbConnection = null;

        function __construct() {
            global $dbConfig;

            if ($this->dbConnection != null) {
                return $this->dbConnection;
            }

            //            if (DEBUG) {
            //                $this->dbConnection = new LoggedPDO('mysql:host=' . $dbConfig['host'] . ';dbname=' . $dbConfig['dbname'],
            //                    $dbConfig['user'], $dbConfig['pass']);
            //            } else {
            $this->dbConnection = new PDO('mysql:host=' . $dbConfig['host'] . ';dbname=' . $dbConfig['dbname'],
                $dbConfig['user'], $dbConfig['pass']);
            //            }

            $this->dbConnection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $this->dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $this->dbConnection;
        }

        function prepare($query) {
            return $this->dbConnection->prepare($query);
        }

        function printLog() {
            if (get_class($this->dbConnection) === "LoggedPDO") {
                $this->dbConnection->printLog();
            }
        }

    }
