<?php

    defined('INSIDE') OR exit('No direct script access allowed');

    require $path['interfaces'] . 'view.interface.php';

    class V_Resources extends View implements I_View {

        private $template = 'resources';

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

            if ($mode != null) {
                $this->template .= '_' . $mode;
            }

            return parent::mergeTemplates($this->template, $this->_);
        }

        /**
         * loads a row for a resource-producing unit
         * @return mixed|string a new row
         * @throws FileNotFoundException
         */
        public function loadResourceRow() {

            global $path;

            ob_start();

            $file = $path['templates'] . $this->template . '_row.template.php';
            if (file_exists($file)) {
                include $file;
            } else {
                throw new FileNotFoundException('File \'' . $file . '\' not found');
            }

            $output = ob_get_contents();
            ob_end_clean();

            foreach ($this->_['lang'] as $a => $b) {
                $output = str_replace("{{$a}}", $b, $output);
            }

            return $output;

        }
    }

