<?php
// MUST require_once "/_var.php", $TO_HOME . "_functions.php", $TO_HOME . "config.php", $TO_HOME . "_routes.php";
if (validate_value($_POST[session_name()] ?? null)) session_id($_POST[session_name()]);
session_start();
function login($session = [], $regen = false)
{
    if ($regen) session_regenerate_id(true);
    setcookie(session_name(), session_id(), time() + 3600, '/', '', true, true);
    $_SESSION = array_merge($_SESSION, $session);
    return true;
}
function logout()
{
    $_SESSION = [];
    session_unset();
    session_destroy();
    setcookie(session_name(), '', time() - 600, '/', '', true, true);
    return false;
}
function check_session()
{
    if (!validate_value($_SESSION["logintime"] ?? null)) return logout();
    if (!validate_value($_SESSION["username"] ?? null)) return logout();
    if (time() - $_SESSION["logintime"] > 3600) return logout();
    return login(["logintime" => time()]);
}
