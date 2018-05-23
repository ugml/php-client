<?php

    defined('INSIDE') OR exit('No direct script access allowed');

    require_once Config::$pathConfig['interfaces'] . 'model.php';

    class M_Login implements I_Model {

        public function loadLanguage() {
            require_once Config::$pathConfig['language'] . Config::$gameConfig['language'] . '/login.php';

            return $lang;

        }

        public function getUserInfo($username) {
            global $debug;

            require_once Config::$pathConfig['classes'] . 'db.php';

            $dbConnection = new Database();

            try {

                $params = array(':username' => $username);

                $stmt = $dbConnection->prepare('SELECT userID, password FROM users WHERE username = :username;');

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
    }
