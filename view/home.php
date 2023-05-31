<?php
    session_start();
    ob_start();
?>

<?php

$content = ob_get_clean();
$title = "home";
require "template.php";