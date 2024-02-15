<?php
// You MUST require_once './_var.php' to get paths, plus require_once $TO_HOME . "_functions.php";
if (isset($_GET['lang'])) {
    switch ($_GET['lang']) {
        case 'es':
        case 'en':
            setcookie('lang', $_GET['lang'], time() + 31536000, '/', '', false, false);
            require_once $TO_HOME . "lang/" . $_GET['lang'] . ".php";
            echo "<html lang='" . $_GET['lang'] . "'>";
            $lang = $_GET['lang'];
            break;
    }
} else if (isset($_COOKIE['lang'])) {
    switch ($_COOKIE['lang']) {
        case 'es':
        case 'en':
            require_once $TO_HOME . "lang/" . $_COOKIE['lang'] . ".php";
            echo "<html lang='" . $_COOKIE['lang'] . "'>";
            $lang = $_COOKIE['lang'];
            break;
    }
} else {
    setcookie('lang', 'es', time() + 31536000, '/', '', false, false);
    require_once $TO_HOME . "lang/es.php";
    echo "<html lang='es'>";
    $lang = 'es';
}
$title_index = $_GET["title"] ?? 0;
$titles = [
    "SPA " . $home . " | byUwUr",
    "SPA " . $page1 . " | byUwUr",
    "SPA " . $page2 . " | byUwUr"
];
