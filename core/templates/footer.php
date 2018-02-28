</div>
</div>
<?php

    if (DEBUG) {

        echo "<br />[ DEBUG ]";

        $debug->printDebugLog();
        $dbConnection->printLog();

        printf("<p>Page created in %.6f seconds.</p>", (microtime(true) - RENDERING_STARTTIME));
    }

?>
</div>


<script src="scripts/functions.js"></script>
</body>
</html>
