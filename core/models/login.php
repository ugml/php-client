<?php

    defined('INSIDE') OR exit('No direct script access allowed');

    require_once $path['interfaces'] . 'model.php';

    class M_Login implements I_Model {

        public static function loadLanguage() {

            global $path, $lang, $config;

            require_once $path['language'] . $config['language'] . '/login.php';

            return $lang;
        }

        public static function getUserInfo($username) {

            global $database, $path, $debug;

            require_once $path['classes'] . 'db.php';

            $db = new Database();

            try {

                $params = array(':username' => $username);

                $stmt = $db->prepare('SELECT userID, password FROM ' . $database['prefix'] . 'users WHERE username = :username;');

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

        public static function loadUserData($userID) {
        }
    }
