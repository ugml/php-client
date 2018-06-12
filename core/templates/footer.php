<?php

    if (basename($_SERVER['PHP_SELF']) === "game.php") {

        //        if(DEBUG) {
        //            echo "<br />[ DEBUG ]";
        //
        //            $debug->printDebugLog();
        //
        //
        //            $dbConnection->printLog();
        //
        //            printf("<p>Page created in %.6f seconds.</p>", (microtime(true) - RENDERING_STARTTIME));
        //        }

        ?>

        </div>
        </div>


        <?php
        if (DEBUG) {
            global $debug;
            $debug->printDebugLog();

            printf("<p>Page created in %.6f seconds.</p>", (microtime(true) - RENDERING_STARTTIME));
        }

        ?>

        </div>

        <footer class="footer">
            <div class="container">
                <span class="text-muted">v {ugamela_version}</span>
            </div>
        </footer>


        <script src="scripts/functions.js"></script>

        <?php

    } else {

        ?>

        <footer>
            <span class="left">
                v {ugamela_version}
            </span>
            <span class="right">
                <a href="register.php">Create a new Account</a> &bull;
                <a href="https://discordapp.com/invite/YDUHM3k" target="_blank">Join our Discord</a> &bull;
                <a href="https://github.com/mamen/ugamela" target="_blank">Contribute on Github</a>
            </span>
        </footer>

        <?php

    }
?>
</body>
</html>
