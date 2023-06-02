<?php
ob_start();
?>

<a>ahahah</a>


<?php

$content = ob_get_clean();
$title = "Détails Genre";
require "template.php";