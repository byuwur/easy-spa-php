<?php
// MUST require_once "/_var.php", $TO_HOME . "_functions.php";
require_once $TO_HOME . "vendor/autoload.php";
$dotenv = Dotenv\Dotenv::createImmutable($TO_HOME);
$dotenv->load();
try {
    //$mysqli = new mysqli($_ENV["DB_HOST"], $_ENV["DB_USER"], $_ENV["DB_PASS"], $_ENV["DB_NAME"], $_ENV["DB_PORT"]);
} catch (Exception $e) {
    api_respond(500, true, "Connection failed" . ($_ENV["APP_ENV"] == "DEV" ? ": " . $e->getCode() . " = " . $e->getMessage() : ""));
}