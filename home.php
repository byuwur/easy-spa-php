<!DOCTYPE html>
<?php
require_once "./_var.php";
require_once $TO_HOME . "_functions.php";
$routes = [
    "/" => ["URI" => "main.php", "GET" => [], "POST" => []],
    "/es" => ["URI" => "", "GET" => ["lang" => "es"], "POST" => []],
    "/en" => ["URI" => "", "GET" => ["lang" => "en"], "POST" => []],
    "/inicio" => ["URI" => "main.php", "GET" => ["lang" => "es"], "POST" => []],
    "/home" => ["URI" => "main.php", "GET" => ["lang" => "en"], "POST" => []],
    "/pagina1" => ["URI" => "page1.php", "GET" => ["lang" => "es"], "POST" => []],
    "/page1" => ["URI" => "page1.php", "GET" => ["lang" => "en"], "POST" => []],
    "/pagina2" => ["URI" => "page2.php", "GET" => ["lang" => "es"], "POST" => []],
    "/page2" => ["URI" => "page2.php", "GET" => ["lang" => "en"], "POST" => []],
];
require_once $TO_HOME . "_router.php";
require_once $TO_HOME . "common.php";
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Easy PHP SPA | byUwUr</title>
    <link rel="icon" type="image/png" href="<?= $HOME_PATH; ?>img/byuwur.png" />
    <link rel="stylesheet" href="<?= $HOME_PATH; ?>css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= $HOME_PATH; ?>css/loading.css" />
    <script src="<?= $HOME_PATH; ?>js/jquery-3.3.1.min.js" defer></script>
    <script src="<?= $HOME_PATH; ?>js/bootstrap.min.js" defer></script>
    <script src="<?= $HOME_PATH; ?>_functions.js" defer></script>
    <script src="<?= $HOME_PATH; ?>_spa.js" defer></script>
</head>

<body>
    <div class="loading">
        <div class="load-circle-back"></div>
        <div class="load-circle-fore"></div>
        <div class="load-text"><?= $load; ?></div>
    </div>
    <video class="video-container" muted loop autoplay>
        <source src="<?= $HOME_PATH; ?>img/bg.mp4" type="video/mp4" />
        <source src="<?= $HOME_PATH; ?>img/bg.webm" type="video/webm" />
    </video>
    <header id="header" class="header"></header>
    <div id="spa-page-content-container" class="video-foreground"></div>
    <footer id="footer" class="footer"></footer>
</body>

</html>