<html>
<head>
    <meta charset="utf-8">
    <title>ugamela</title>
    <link rel="shortcut icon" href="../images/favicon.png" type="image/x-icon"/>
    <link rel="stylesheet" href="../css/reset.css"/>
    <link rel="stylesheet" href="../css/installer.css"/>
    <link href='https://fonts.googleapis.com/css?family=Amiko|Ramabhadra' rel='stylesheet' type='text/css'>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>
<body>

<?php

    // indicates, wether the input-fields should be displayer
    $displayPage = true;

    // if a config-file already exists, throw an error
    if(file_exists(dirname(dirname(__FILE__)) . "/core/config.php")) {
        $errorMessage = "ERROR: There is already an existing configuration-file!";
        $displayPage = false;
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST') {

        // filter input
        $dbHost = filter_input(INPUT_POST, 'dbHost', FILTER_SANITIZE_STRING);
        $dbPort = filter_input(INPUT_POST, 'dbPort', FILTER_VALIDATE_INT);
        $dbUser = filter_input(INPUT_POST, 'dbUser', FILTER_SANITIZE_STRING);
        $dbPass = filter_input(INPUT_POST, 'dbPass', FILTER_SANITIZE_STRING);
        $dbName = filter_input(INPUT_POST, 'dbName', FILTER_SANITIZE_STRING);
        
        // port default-value
        if($dbPort === 0) {
            $dbPort = 3306;
        }

        // load the database-class
        require_once "../core/classes/database.php";

        $dbConnection = new Database($dbHost, $dbName, $dbPort, $dbUser, $dbPass);

        // some data was wrong
        if($dbConnection->getConnection() instanceof PDOException) {
            $errorMessage = "Could not create a database-connection: <br />" . $dbConnection->getConnection()->getMessage();
        } else {
            // connection could be established
            // 1. create database and import data
            $dbConnection->getConnection();

            // create the queries
            $query = "CREATE DATABASE IF NOT EXISTS `{$dbName}`; USE `{$dbName}`;";
            $sqlScript = file('data/ugamela.sql');
            foreach ($sqlScript as $line)	{

                $startWith = substr(trim($line), 0 ,2);
                $endWith = substr(trim($line), -1 ,1);

                if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
                    continue;
                }

                $query = $query . $line;
            }


            $stmt = $dbConnection->prepare($query);

            $stmt->execute();


            // 2. create Config.php
            // get the sample-config
            $configFile = file_get_contents('data/config.sample.php');

            // replace the placeholders with the values given by the user
            $configFile = str_replace("Config_sample", "Config", $configFile);
            $configFile = str_replace("DBHOST", $dbHost, $configFile);
            $configFile = str_replace("DBPORT", $dbPort, $configFile);
            $configFile = str_replace("DBNAME", $dbName, $configFile);
            $configFile = str_replace("DBUSER", $dbUser, $configFile);
            $configFile = str_replace("DBPASS", $dbPass, $configFile);

            // write the data to a new config-file
            file_put_contents("../core/config.php", $configFile);


            $successMessage = "Game successfully installed<br /><a href='../register.php'>Click here to create a new account</a>";
        }
    }

?>


<div id='title'>
    <img src="../images/logo.png"/><br/>
    <span>Setup</span><br/>
    <?php
        if(isset($errorMessage)) {
            echo "<p class='errorMsg'>{$errorMessage}</p>";
        }

        if(isset($successMessage)) {
            echo "<p class='successMsg'>{$successMessage}</p>";
        }


        if($displayPage) {
    ?>
    <form method="post">
        <input type="text" name="dbHost" placeholder="Host" autocomplete="off" /><br/>
        <input type="text" name="dbUser" placeholder="Username" autocomplete="off" /><br/>
        <input type="password" name="dbPass" placeholder="Password" autocomplete="off" /><br/>
        <input type="text" name="dbName" placeholder="Database" autocomplete="off" /><br/>
        <input type="text" name="dbPort" placeholder="Port" autocomplete="off" /><br/>
        <input type="submit" value="Install"/>
    </form>
    <?php } ?>
</div>

<footer>
    <span class="left">
    </span>
    <span class="right">
        <a href="https://discordapp.com/invite/YDUHM3k" target="_blank">Join our Discord</a> &bull;
        <a href="https://github.com/mamen/ugamela" target="_blank">Contribute on Github</a>
    </span>
</footer>

</body>
</html>



