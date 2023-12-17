<?php
$url = $_GET["uri"] ?? "/";
while (strlen($url) > 0 && substr($url, 0, 1) != "/") $url = substr($url, 1);
while (strlen($url) > 1 && substr($url, -1) == "/") $url = substr($url, 0, -1);
if (strpos($url, "/\$/") !== false) {
    list($url, $params) = explode("/\$/", $url, 2);
    $param_key_value = explode("/", $params);
    for ($i = 0; $i < count($param_key_value); $i += 2)
        if (isset($param_key_value[$i + 1]))
            $_GET[$param_key_value[$i]] = $param_key_value[$i + 1];
}
if (!array_key_exists($url, $routes) || empty($routes) || (!isset($routes[$url]["URI"]) && !isset($routes[$url]["FILE"]))) {
    $_GET["e"] = 404;
    $_POST["custom_error_message"] = "Route \"" . $url . "\" does not exist.";
    require_once "_error.php";
    exit;
}
if (array_key_exists($url, $routes) && isset($routes[$url]["FILE"])) {
    header("Content-Type: " . get_mime_type($routes[$url]["FILE"]));
    header("Content-Disposition: inline; filename=\"" . basename($routes[$url]["FILE"]) . "\"");
    readfile($routes[$url]["FILE"]);
    exit;
}
$_GET = [...$_GET, ...$routes[$url]["GET"] ?? []];
$_POST = [...$_POST, ...$routes[$url]["POST"] ?? []];
?>
<script>
    localStorage.setItem("URI", "<?= $url; ?>");
    localStorage.setItem("ROUTES", JSON.stringify(<?= json_encode($routes) ?>));
    localStorage.setItem("_GET", JSON.stringify(<?= json_encode($_GET) ?>));
    localStorage.setItem("_POST", JSON.stringify(<?= json_encode($_POST) ?>));
</script>