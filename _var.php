<?php
ob_start();
// require_once "./_var.php" must be the first line of every file
$SYSTEM_ROOT = dirname(str_replace("\\", "/", __FILE__));
$PROTOCOL = isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on" ? "https://" : "http://";
$PATH_DIFF = count(explode("/", str_replace("\\", "/", $_SERVER["SCRIPT_FILENAME"]))) - count(explode("/", str_replace("\\", "/", __FILE__)));
$TO_HOME = $PATH_DIFF ? str_repeat("../", $PATH_DIFF) : "./";
$THIS_PATH = str_replace("\\", "/",  dirname($PROTOCOL . $_SERVER["HTTP_HOST"] . $_SERVER["PHP_SELF"]));
$HOME_PATH = $PATH_DIFF ? implode("/", array_slice(explode("/", $THIS_PATH), 0, -$PATH_DIFF)) : $THIS_PATH;
// --- local storage ---
if (isset($setLocalStorage) && $setLocalStorage) { ?>
    <script>
        localStorage.setItem("PROTOCOL", "<?= $PROTOCOL; ?>");
        localStorage.setItem("PATH_DIFF", "<?= $PATH_DIFF; ?>");
        localStorage.setItem("TO_HOME", "<?= $TO_HOME; ?>");
        localStorage.setItem("THIS_PATH", "<?= $THIS_PATH; ?>");
        localStorage.setItem("HOME_PATH", "<?= $HOME_PATH; ?>");
    </script>
<?php }
