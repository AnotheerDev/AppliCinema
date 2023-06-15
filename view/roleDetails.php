<?php
ob_start();
?>



<?php

$content = ob_get_clean();
$title = "Rôle détails";
require "template.php";
