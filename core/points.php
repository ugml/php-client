<?php

    defined('INSIDE') OR exit('No direct script access allowed');

    require_once 'config.php';
    require_once $path['classes'] . 'db.class.php';

    $db = new Database();
