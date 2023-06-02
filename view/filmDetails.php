<?php
ob_start();
?>



<h2><?= $film['titre'] ?></h2>
<p>Date de sortie : <?= $film['dateSortie'] ?></p>
<p>Durée : <?= $film['duree'] ?> minutes</p>
<p>Synopsis : <?= $film['synopsis'] ?></p>
<p>Note : <?= $film['note'] ?></p>
<p>Réalisateur : <?= $film['nom'] ?></p>

<?php

$content = ob_get_clean();
$title = "Détails film";
require "template.php";
