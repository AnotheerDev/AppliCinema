<?php
ob_start();
?>

<?php

$content = ob_get_clean();
$title = "Ajout Casting - Star";
require "template.php";
