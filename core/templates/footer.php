</div>
</div>
<?php

    if (DEBUG && basename($_SERVER['PHP_SELF']) === "game.php") {

        echo "<br />[ DEBUG ]";

        $debug->printDebugLog();


        $dbConnection->printLog();

        printf("<p>Page created in %.6f seconds.</p>", (microtime(true) - RENDERING_STARTTIME));
    }

?>

</div>


<?php

    // display ingame-footer
    if(basename($_SERVER['PHP_SELF']) === "game.php") {

    ?>

        <footer class="footer">
            <div class="container">
                <span class="text-muted">v {ugamela_version}</span>
            </div>
        </footer>


        <script src="scripts/functions.js"></script>

    <?php

    }
?>
</body>
</html>
