<?php

    /**
     * This class connects to the MySQL-Database and provides a database connection object
     */
    class Database {

        /** @var null|PDO the database connection object */
        private $dbConnection = null;

        /**
         * Database constructor.
         * Connects to the MySQL-Database and creates a database-object
         */
        function __construct() {

            // if the connection was already made, return the connection-object
            if ($this->dbConnection != null) {
                return $this->dbConnection;
            }

            $this->dbConnection = new PDO('mysql:host=' . Config::$dbConfig['host'] . ';dbname=' . Config::$dbConfig['dbname'] . ';port=' . Config::$dbConfig['port'],
                Config::$dbConfig['user'], Config::$dbConfig['pass']);

            $this->dbConnection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $this->dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $this->dbConnection;
        }

        /**
         * Prepares the given query
         * @param $query the query
         * @return PDOStatement a prepared PDO-query
         */
        function prepare($query) : PDOStatement {
            return $this->dbConnection->prepare($query);
        }

        /**
         * prints the debug-log
         * @codeCoverageIgnore
         */
        function printLog() {
            if (get_class($this->dbConnection) === "LoggedPDO") {
                $this->dbConnection->printLog();
            }
        }

    }
