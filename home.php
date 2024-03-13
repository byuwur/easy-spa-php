<!DOCTYPE html>
<?php
$setLocalStorage = true;
require_once "./_var.php";
require_once $TO_HOME . "_functions.php";
//require_once $TO_HOME . "_config.php";
require_once $TO_HOME . "_routes.php";
require_once $TO_HOME . "_router.php";
//require_once $TO_HOME . "_auth.php";
require_once $TO_HOME . "common.php";
// --- PHP ---
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Easy PHP SPA | byUwUr</title>
    <link rel="icon" type="image/png" href="<?= $HOME_PATH; ?>/img/byuwur.png" />
    <link rel="stylesheet" href="<?= $HOME_PATH; ?>/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= $HOME_PATH; ?>/css/loading.css" />
    <script src="<?= $HOME_PATH; ?>/js/jquery-3.3.1.min.js" defer></script>
    <script src="<?= $HOME_PATH; ?>/js/bootstrap.min.js" defer></script>
    <script src="<?= $HOME_PATH; ?>/_functions.js" defer></script>
    <script src="<?= $HOME_PATH; ?>/_spa.js" defer></script>
</head>

<body>
    <div id="spa-loader" class="loading">
        <div class="load-circle-back"></div>
        <div class="load-circle-fore"></div>
        <div class="load-text"><?= $load; ?></div>
    </div>
    <video class="video-container" muted loop autoplay>
        <source src="<?= $HOME_PATH; ?>/img/bg.mp4" type="video/mp4" />
        <source src="<?= $HOME_PATH; ?>/img/bg.webm" type="video/webm" />
    </video>
    <header id="header"></header>
    <div id="spa-page-content-container"></div>
    <footer id="footer"></footer>
</body>

</html>
<?php
//login([], true);
// Always output due to "/_var.php" invoking ob_start();
ob_end_flush();
?>