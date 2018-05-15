<?php

    /**
     * This class connects to the MySQL-Database and provides a database connection object
     */
    class Database {

        /** @var null|PDO the database connection object */
        private static $dbConnection = null;

        /**
         * Database constructor.
         * Connects to the MySQL-Database and creates a database-object
         */
        function __construct() {

            // if the connection was already made, return the connection-object
            if (self::$dbConnection != null) {
                return self::$dbConnection;
            }

            self::$dbConnection = new PDO('mysql:host=' . Config::$dbConfig['host'] . ':'.Config::$dbConfig['port'].';dbname=' . Config::$dbConfig['dbname'],
                Config::$dbConfig['user'], Config::$dbConfig['pass']);

            self::$dbConnection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            self::$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return self::$dbConnection;
        }

        /**
         * Prepares the given query
         * @param $query the query
         * @return PDOStatement a prepared PDO-query
         */
        function prepare($query) : PDOStatement {
            return self::$dbConnection->prepare($query);
        }

        /**
         * prints the debug-log
         * @codeCoverageIgnore
         */
        function printLog() {
            if (get_class(self::$dbConnection) === "LoggedPDO") {
                self::$dbConnection->printLog();
            }
        }

    }
