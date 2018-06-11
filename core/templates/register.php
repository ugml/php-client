<div id='stars'></div>
<div id='stars2'></div>
<div id='stars3'></div>
<div id='title'>
    <a href="login.php"><img src="images/logo.png"/></a>

    <?php

        if ($this->_['success']) {
            ?>
            <br/><br/>
            <h2>{register_success}</h2>
            <br/>
            <a href="login.php">{go_to_login}</a>
            <?php

        } else {
            ?>
            <br/>
            <span>OPEN</span>
            <span>ALPHA</span>
            <form action="" method="post" autocomplete="off">
                <input name="username" type="text" maxlength="20" autocomplete="off" placeholder="{username}"/><br/>
                <!--        <input name="planetname" type="text" maxlength="20" autocomplete="off"-->
                <!--               placeholder="{homeplanet_name}"/><br/>-->
                <input name="email" type="text" maxlength="40" autocomplete="off" placeholder="{email}"/><br/>
                <input name="password" type="password" minlength="4" autocomplete="off" placeholder="{password}"/><br/>
                <!--        <input type="checkbox" name="agb"/>{accept_tc}<br/>-->
                <input type="submit" value="- {signup} -"/>
            </form>
            <br/>
            <a href="login.php">Back to login</a>
            <?php

        }
    ?>

</div>