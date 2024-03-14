<?php
// routes
$ROOT_ROUTE = "/";
// components
$ROOT_COMPONENTS = ["COMPONENT" => ["#header" => "/header.php", "#footer" => "/footer.php"]];
// ---
$routes = [
    // "/uri" => ["URI" => "/file.php", "GET" => [..."key" => "value"...], "POST" => [..."key" => "value"...], "COMPONENT" => [..."#id" => "file.php"...]],
    // "/" routes
    $ROOT_ROUTE => ["URI" => "/main.php", ...$ROOT_COMPONENTS],
    $ROOT_ROUTE . "es" => ["URI" => "", "GET" => ["lang" => "es"], ...$ROOT_COMPONENTS],
    $ROOT_ROUTE . "en" => ["URI" => "", "GET" => ["lang" => "en"], ...$ROOT_COMPONENTS],
    $ROOT_ROUTE . "inicio" => ["URI" => "/main.php", "GET" => ["lang" => "es"], ...$ROOT_COMPONENTS],
    $ROOT_ROUTE . "home" => ["URI" => "/main.php", "GET" => ["lang" => "en"], ...$ROOT_COMPONENTS],
    $ROOT_ROUTE . "pagina1" => ["URI" => "/page1.php", "GET" => ["lang" => "es"], ...$ROOT_COMPONENTS],
    $ROOT_ROUTE . "page1" => ["URI" => "/page1.php", "GET" => ["lang" => "en"], ...$ROOT_COMPONENTS],
    $ROOT_ROUTE . "pagina2" => ["URI" => "/page2.php", "GET" => ["lang" => "es"], ...$ROOT_COMPONENTS],
    $ROOT_ROUTE . "page2" => ["URI" => "/page2.php", "GET" => ["lang" => "en"], ...$ROOT_COMPONENTS],
];
