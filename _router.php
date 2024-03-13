<?php
// MUST require_once $TO_HOME . "_functions.php"; and $routes/_routes.php MUST be previously defined/required
$uri = $_GET["uri"] ?? "/";
while (strlen($uri) > 0 && substr($uri, 0, 1) != "/") $uri = substr($uri, 1);
while (strlen($uri) > 1 && substr($uri, -1) == "/") $uri = substr($uri, 0, -1);
$url = $uri;
if (strpos($uri, "/\$/") !== false) {
    list($uri, $params) = explode("/\$/", $uri, 2);
    $param_key_value = explode("/", $params);
    for ($i = 0; $i < count($param_key_value); $i += 2)
        if (isset($param_key_value[$i + 1]))
            $_GET[$param_key_value[$i]] = $param_key_value[$i + 1];
}
if (!array_key_exists($uri, $routes) || empty($routes) || (!isset($routes[$uri]["URI"]) && !isset($routes[$uri]["FILE"]))) {
    $_GET["e"] = 404;
    $_POST["custom_error_message"] = "Route \"" . $uri . "\" does not exist.";
    require_once "_error.php";
    exit;
}
if (array_key_exists($uri, $routes) && isset($routes[$uri]["FILE"])) {
    header("Content-Type: " . get_mime_type($routes[$uri]["FILE"]));
    header("Content-Disposition: inline; filename=\"" . basename($routes[$uri]["FILE"]) . "\"");
    readfile($routes[$uri]["FILE"]);
    exit;
}
$_GET = [...$_GET, ...$routes[$uri]["GET"] ?? []];
$_POST = [...$_POST, ...$routes[$uri]["POST"] ?? []];
?>
<script>
    localStorage.setItem("URI", "<?= $uri; ?>");
    localStorage.setItem("URL", "<?= $url; ?>");
    localStorage.setItem("ROUTES", JSON.stringify(<?= json_encode($routes) ?>));
    localStorage.setItem("_GET", JSON.stringify(<?= json_encode($_GET) ?>));
    localStorage.setItem("_POST", JSON.stringify(<?= json_encode($_POST) ?>));
</script>