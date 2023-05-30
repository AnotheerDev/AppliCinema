<?php
    session_start();
    ob_start();
?>

<?php

$content = ob_get_clean();
$title = "films";
require "template.php";
