<!DOCTYPE html>
<?php
require_once "./_var.php";
$routes = [
    "/" => ["URI" => "main.php", "GET" => [], "POST" => [], "COMPONENT" => ["#header" => "header.php", "#footer" => "footer.php", "head" => "head.php"]],
    "/es" => ["URI" => "", "GET" => ["lang" => "es"], "POST" => [], "COMPONENT" => ["#header" => "header.php", "#footer" => "footer.php", "head" => "head.php"]],
    "/en" => ["URI" => "", "GET" => ["lang" => "en"], "POST" => [], "COMPONENT" => ["#header" => "header.php", "#footer" => "footer.php", "head" => "head.php"]],
    "/inicio" => ["URI" => "main.php", "GET" => ["lang" => "es"], "POST" => [], "COMPONENT" => ["#header" => "header.php", "#footer" => "footer.php", "head" => "head.php"]],
    "/home" => ["URI" => "main.php", "GET" => ["lang" => "en"], "POST" => [], "COMPONENT" => ["#header" => "header.php", "#footer" => "footer.php", "head" => "head.php"]],
    "/pagina1" => ["URI" => "page1.php", "GET" => ["lang" => "es"], "POST" => [], "COMPONENT" => ["#header" => "header.php", "#footer" => "footer.php", "head" => "head.php"]],
    "/page1" => ["URI" => "page1.php", "GET" => ["lang" => "en"], "POST" => [], "COMPONENT" => ["#header" => "header.php", "#footer" => "footer.php", "head" => "head.php"]],
    "/pagina2" => ["URI" => "page2.php", "GET" => ["lang" => "es"], "POST" => [], "COMPONENT" => ["#header" => "header.php", "#footer" => "footer.php", "head" => "head.php"]],
    "/page2" => ["URI" => "page2.php", "GET" => ["lang" => "en"], "POST" => [], "COMPONENT" => ["#header" => "header.php", "#footer" => "footer.php", "head" => "head.php"]],
];
require_once $TO_HOME . "_functions.php";
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
    <header id="header"></header>
    <div id="spa-page-content-container"></div>
    <footer id="footer"></footer>
</body>

</html>