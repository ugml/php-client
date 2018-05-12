<?php

    declare(strict_types = 1);

    class V_View {

        private $_ = array();

        /**
         * merges all used templates on the current page into one
         * @param $class
         * @param $fields
         * @return string
         * @throws FileNotFoundException
         */
        public function mergeTemplates($class, $fields) : string {

            global $dbConnection, $debug;

            $this->_ = $fields;

            // write the output into a buffer
            ob_start();

            $file = Config::$pathConfig['templates'] . 'header.php';
            if (file_exists($file)) {
                require_once $file;
            } else {
                throw new FileNotFoundException('File \'' . $file . '\' not found');
            }

            $file = Config::$pathConfig['templates'] . 'menu.php';
            if (file_exists($file)) {
                require_once $file;
            } else {
                throw new FileNotFoundException('File \'' . $file . '\' not found');
            }

            $file = Config::$pathConfig['templates'] . 'topbar.php';
            if (file_exists($file)) {
                require_once $file;
            } else {
                throw new FileNotFoundException('File \'' . $file . '\' not found');
            }

            $file = Config::$pathConfig['templates'] . $class . '.php';
            if (file_exists($file)) {
                require_once $file;
            } else {
                throw new FileNotFoundException('File \'' . $file . '\' not found');
            }

            $file = Config::$pathConfig['templates'] . 'footer.php';
            if (file_exists($file)) {
                require_once $file;
            } else {
                throw new FileNotFoundException('File \'' . $file . '\' not found');
            }

            $output = ob_get_contents();

            ob_end_clean();

            // parse the language
            foreach ($this->_['lang'] as $a => $b) {
                $output = str_replace("{{$a}}", $b, $output);
            }

            return $output;
        }
    }
