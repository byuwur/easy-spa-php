<?php
$_GET["title"] = 2;
require_once "./_var.php";
require_once $TO_HOME . "common.php";
?>
<div class="container vh-100 d-flex flex-column align-items-center justify-content-center text-white">
    <p><?= $description; ?></p>
    <p><?= $thisis . " " . $page2; ?>.</p>
    <p><?= $page2 . ": "; ?><b><i>"<?= $page2_desc; ?>"</i></b></p>
</div>
<script>
    document.title = "<?= $titles[$title_index]; ?>";
</script>