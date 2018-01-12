<?php

    defined('INSIDE') OR exit('No direct script access allowed');

    interface I_Controller {
        function __construct($get, $post);
        function handleGET() : void;
        function handlePOST() : void;
        function display() : void;
    }
