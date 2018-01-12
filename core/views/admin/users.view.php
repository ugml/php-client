<?php

    defined('INSIDE') OR exit('No direct script access allowed');

    class V_Users {

        private $template = 'users';

        private $_ = array();

        /**
         * assigns the variables for the view
         *
         * @param String $key   Schlüssel
         * @param String $value Variable
         */
        public function assign($key, $value) {

            $this->_[$key] = $value;
        }

        /**
         * sets the name of the template which will be used
         *
         * @param String $template Name des Templates.
         */
        public function setTemplate($template = 'resources') {

            $this->template = $template;
        }

        /**
         * this loads the template file
         *
         * @param string $mode the subtemplate (e.g. resources_row.template.php)
         * @return string the template
         * @throws FileNotFoundException
         */
        public function loadTemplate($mode = null) {

            global $path;

            if ($mode != null) {
                $this->template .= '_' . $mode;
            }

            // write the output into a buffer
            ob_start();

            $file = $path['templates'] . 'header.template.php';
            if (file_exists($file)) {
                include $file;
            } else {
                throw new FileNotFoundException('File \'' . $file . '\' not found');
            }

            $file = $path['templates'] . 'admin/topbar.template.php';
            if (file_exists($file)) {
                include $file;
            } else {
                throw new FileNotFoundException('File \'' . $file . '\' not found');
            }

            $file = $path['templates'] . 'admin/menu.template.php';
            if (file_exists($file)) {
                include $file;
            } else {
                throw new FileNotFoundException('File \'' . $file . '\' not found');
            }

            $file = $path['templates'] . 'admin/' . $this->template . '.template.php';
            if (file_exists($file)) {
                include $file;
            } else {
                throw new FileNotFoundException('File \'' . $file . '\' not found');
            }

            $file = $path['templates'] . 'footer.template.php';
            if (file_exists($file)) {
                include $file;
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

