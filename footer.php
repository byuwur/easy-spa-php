<?php
require_once "./_var.php";
//require_once $TO_HOME . "_functions.php";
//require_once $TO_HOME . "_config.php";
require_once $TO_HOME . "_routes.php";
//require_once $TO_HOME . "_router.php";
//require_once $TO_HOME . "_auth.php";
require_once $TO_HOME . "common.php";
// --- PHP ---
?>
<nav class="navbar fixed-bottom navbar-expand navbar-dark bg-dark text-white m-0 d-flex justify-content-end">
    <ul class="navbar-nav mr-auto mt-1">
        <li class="nav-item"><a href="<?= $ROOT_ROUTE; ?>es" title="Español" class="btn btn-dark"><img src="img/co.png" width="16px" height="12px" style="margin:0 0 4px 0;" alt="" /> ES</a></li>
        <li class="nav-item"> <a href="<?= $ROOT_ROUTE; ?>en" title="English" class="btn btn-dark"><img src="img/uk.png" width="16px" height="12px" style="margin:0 0 4px 0;" alt="" /> EN</a></li>
        <li class="nav-item"><a class="btn btn-dark" href="<?= $ROOT_ROUTE ?>error"><i class="fas fa-chalkboard-teacher"></i>Error</a></li>
    </ul>
</nav>
<?php
//login([], true);
// Always output due to "/_var.php" invoking ob_start();
ob_end_flush();
?>