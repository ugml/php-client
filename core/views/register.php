<?php

    defined('INSIDE') OR exit('No direct script access allowed');

    class V_Register implements I_View {

        // Pfad zum Template
        private Config::$pathConfig = 'core/templates';

        // Name des Templates, in dem Fall das Standardtemplate.
        private $template = 'register';

        /**
         * Enthält die Variablen, die in das Template eingebetet
         * werden sollen.
         */
        private $_ = array();

        /**
         * Ordnet eine Variable einem bestimmten Schl&uuml;ssel zu.
         *
         * @param String $key   Schlüssel
         * @param String $value Variable
         */
        public function assign($key, $value) {

            $this->_[$key] = $value;
        }

        /**
         * Setzt den Namen des Templates.
         *
         * @param String $template Name des Templates.
         */
        public function setTemplate($template = 'default') {

            $this->template = $template;
        }

        /**
         * Das Template-File laden und zurückgeben
         *
         * @param string $tpl   Der Name des Template-Files (falls es nicht vorher
         *                      über steTemplate() zugewiesen wurde).
         * @return string Der Output des Templates.
         */
        public function loadTemplate($mode = null) {

            // Pfad zum Template erstellen & überprüfen ob das Template existiert.
            $file = $this->path . DIRECTORY_SEPARATOR . $this->template . '.php';

            $exists = file_exists($file);

            if ($exists) {
                // Der Output des Scripts wird n einen Buffer gespeichert, d.h.
                // nicht gleich ausgegeben.
                ob_start();

                include $this->path . DIRECTORY_SEPARATOR . 'header_login.php';
                include $file;
                include $this->path . DIRECTORY_SEPARATOR . 'footer.php';

                $output = ob_get_contents();

                ob_end_clean();

                foreach ($this->_['lang'] as $a => $b) {
                    $output = str_replace("{{$a}}", $b, $output);
                }

                return $output;
            } else {
                // Template-File existiert nicht-> Fehlermeldung.
                return 'could not find template';
            }
        }
    }
