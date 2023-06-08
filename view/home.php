<?php
    session_start();
    ob_start();
?>

<h1>HOME</h1>

<?php
$content = ob_get_clean();
$title = "home";
require "template.php";