<?php

    defined('INSIDE') OR exit('No direct script access allowed');

    interface I_View {

        public function assign($key, $value);

        public function setTemplate($template);

        public function loadTemplate($mode = null);
    }
