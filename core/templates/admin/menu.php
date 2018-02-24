<?php

    defined('INSIDE') OR exit('No direct script access allowed');

?>
<ul class="menu">
    <li title="dashboard"><a href="?page=dashboard" class="dashboard">menu</a></li>
    <li title="users"><a href="?page=users" class="users">users</a></li>
    <li title="planets"><a href="?page=planets" class="planets">planets</a></li>
    <li title="reports"><a href="?page=reports" class="reports">reports</a></li>
    <li title="errors"><a href="?page=errors" class="errors">errors</a></li>
    <li title="logout"><a href="game.php?page=overview" class="logout">logout</a></li>
</ul>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var page = "<?php echo $_GET['page']; ?>";

        var item = document.getElementsByClassName(page);

        item[0]
        List.add("active");
    });
</script>
