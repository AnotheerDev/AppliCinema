<?php
ob_start();
?>

<?php

$content = ob_get_clean();
$title = "Détails film";
require "template.php";
