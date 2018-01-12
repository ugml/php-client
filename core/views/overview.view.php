<?php

    defined('INSIDE') OR exit('No direct script access allowed');

    require $path['interfaces'].'view.interface.php';

    class V_Overview extends View implements I_View {

        private $template = 'overview';

        private $_ = array();

        /**
         * assigns the variables for the view
         *
         * @param String $key Schlüssel
         * @param String $value Variable
         */
        public function assign($key, $value){
            $this->_[$key] = $value;
        }


        /**
         * sets the name of the template which will be used
         *
         * @param String $template Name des Templates.
         */
        public function setTemplate($template){
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

            if($mode != null) {
                $this->template .= '_'.$mode;
            }

            return parent::mergeTemplates($this->template, $this->_);
        }
    }

