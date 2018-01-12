<?php

    if (!empty($_POST)) {
        if (isset($_POST['email'])) {
            $mysqli = new mysqli("mamen.at.mysql", "mamen_at_ugamela", "2uE2YpAJVUK2euM7", "mamen_at_ugamela");

            mysqli_query($mysqli,
                "INSERT INTO `mamen_at_ugamela`.`beta_tester` (`num`, `email`) VALUES (NULL, '" . $mysqli->real_escape_string($_POST['email']) . "');");

            $message = "asd";
        }
    }

?>
<div id='stars'></div>
<div id='stars2'></div>
<div id='stars3'></div>
<div id='title'>
    <img src="images/logo.png"/>
    <br>
    <span>CLOSED</span>
    <span>ALPHA</span>
    <br>
    <form method="post">
        <input type="text" name="username" placeholder="Username"/><br/>
        <input type="password" name="password" placeholder="Password"/><br/>
        <input type="submit" value="- Login -"/>
    </form>
    <?php if (isset($message) && $message != null) {
        echo "<div class=\"message\">Thank you for your registration. We will contact you, as soon as we pick new testers.</div>";
    } ?>
</div>
