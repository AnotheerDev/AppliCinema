<?php
ob_start();
?>


<p>blabla</p>


    <?php

    $content = ob_get_clean();
    $title = "Ajout Star";
    require "template.php";