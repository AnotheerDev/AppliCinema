<?php
ob_start();
?>

<h2><?= $personne['nom'] ?> <?= $personne['prenom'] ?></h2>
<p>est un(e) : <?= $personne['sexe'] ?></p>
<p>né(e) le : <?= $personne['dateNaissance'] ?></p>



<?php

$content = ob_get_clean();
$title = "Détails film";
require "template.php";