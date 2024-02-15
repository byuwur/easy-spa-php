<!DOCTYPE html>
<?php
$routes = [
    //"/uri" => ["URI" => "file.php", "GET" => ["key" => "value"], "POST" => ["key" => "value"], "COMPONENT" => ["#id" => "file.php"]],
    "/" => ["URI" => "main.php", "COMPONENT" => ["#header" => "header.php", "#footer" => "footer.php"]],
    "/es" => ["URI" => "", "GET" => ["lang" => "es"], "COMPONENT" => ["#header" => "header.php", "#footer" => "footer.php"]],
    "/en" => ["URI" => "", "GET" => ["lang" => "en"], "COMPONENT" => ["#header" => "header.php", "#footer" => "footer.php"]],
    "/inicio" => ["URI" => "main.php", "GET" => ["lang" => "es"], "COMPONENT" => ["#header" => "header.php", "#footer" => "footer.php"]],
    "/home" => ["URI" => "main.php", "GET" => ["lang" => "en"], "COMPONENT" => ["#header" => "header.php", "#footer" => "footer.php"]],
    "/pagina1" => ["URI" => "page1.php", "GET" => ["lang" => "es"], "COMPONENT" => ["#header" => "header.php", "#footer" => "footer.php"]],
    "/page1" => ["URI" => "page1.php", "GET" => ["lang" => "en"], "COMPONENT" => ["#header" => "header.php", "#footer" => "footer.php"]],
    "/pagina2" => ["URI" => "page2.php", "GET" => ["lang" => "es"], "COMPONENT" => ["#header" => "header.php", "#footer" => "footer.php"]],
    "/page2" => ["URI" => "page2.php", "GET" => ["lang" => "en"], "COMPONENT" => ["#header" => "header.php", "#footer" => "footer.php"]],
];
$setLocalStorage = true;
require_once "./_var.php";
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
    <div id="spa-loader" class="loading">
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