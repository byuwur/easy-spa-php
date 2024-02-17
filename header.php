<?php
require_once "./_var.php";
require_once $TO_HOME . "common.php";
?>
<nav class="navbar fixed-top navbar-expand navbar-dark bg-dark text-white m-0">
    <a href="<?= $ROOT_ROUTE; ?>" class="navbar-brand mx-3"><img src="<?= $TO_HOME; ?>img/byuwur.png" width="32px" height="32px" /><strong class="navbar-toggler">SPA | byUwUr</strong></a>
    <ul class="navbar-nav mr-auto mt-1">
        <li class="nav-item"><a class="btn btn-dark" href="<?= $ROOT_ROUTE . $_home; ?>"><i class="fas fa-home"></i><?= $home; ?></a></li>
        <li class="nav-item"><a class="btn btn-dark" href="<?= $ROOT_ROUTE . $_page1; ?>"><i class="fas fa-chalkboard-teacher"></i><?= $page1; ?></a></li>
        <li class="nav-item"><a class="btn btn-dark" href="<?= $ROOT_ROUTE . $_page2; ?>"><i class="fas fa-chalkboard-teacher"></i><?= $page2; ?></a></li>
        <li class="nav-item"><a class="btn btn-dark" href="<?= $ROOT_ROUTE ?>error"><i class="fas fa-chalkboard-teacher"></i>Error</a></li>
    </ul>
</nav>