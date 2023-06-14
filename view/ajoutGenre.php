<?php
ob_start();
?>

<div>
    <p>Ajouter un nouveau genre : </p>

    <form action="index.php?action=addGenre" method="post">
        <input type="text" name="nom" maxlength="50" placeholder="genre">
        <input type="submit" name="submit" value="Ajouter">
    </form>
</div>

<?php

$content = ob_get_clean();
$title = "Ajout Genre";
require "template.php";
