<?php

    defined('INSIDE') OR exit('No direct script access allowed');

    require_once $path['interfaces'] . 'model.interface.php';

    class M_Login implements I_Model {

        public static function loadLanguage() {

            global $path, $lang, $config;

            require_once $path['language'] . $config['language'] . '/login.language.php';

            return $lang;
        }

        public static function getUserInfo($username) {

            global $database, $path;

            require_once $path['classes'] . 'db.class.php';

            $db = new Database();

            try {

                $params = array(':username' => $username);

                $stmt = $db->prepare('SELECT userID, password FROM ' . $database['prefix'] . 'users WHERE username = :username;');

                $stmt->execute($params);

                return $stmt->fetch();
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }

        public static function loadUserData($userID) {
        }
    }
