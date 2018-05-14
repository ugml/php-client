<?php

    defined('INSIDE') OR exit('No direct script access allowed');

    class M_Login implements I_Model {

        public function loadLanguage() {
            require_once Config::$pathConfig['language'] . Config::$gameConfig['language'] . '/login.php';

            return $lang;

        }

        public function getUserInfo($username) {
            global $debug;

            $dbConnection = new Database();

            try {

                $params = array(':username' => $username);

                $stmt = $dbConnection->prepare('SELECT userID, password FROM ' . Config::$dbConfig['prefix'] . 'users WHERE username = :username;');

                $stmt->execute($params);

                return $stmt->fetch();
            } catch (PDOException $e) {
                if (DEBUG) {
                    $debug->addLog(self::class, __FUNCTION__, __LINE__, get_class($e), $e->getMessage());
                } else {
                    $debug->saveError(self::class, __FUNCTION__, __LINE__, get_class($e), $e->getMessage());
                }
            }
        }

        public function loadUserData($userID) {
        }
    }
