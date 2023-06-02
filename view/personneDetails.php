<?php
ob_start();
?>

<h2><?= $personne['nom'] ?> <?= $personne['prenom'] ?></h2>
<p>est un(e) : <?= $personne['sexe'] ?></p>
<p>né(e) le : <?= $personne['dateNaissance'] ?></p>
<p>est un(e) :
    <?php if ($personne['idRealisateur'] && $personne['idActeur']) : ?>
        Acteur et réalisateur
    <?php elseif ($personne['idRealisateur']) : ?>
        Réalisateur
    <?php elseif ($personne['idActeur']) : ?>
        Acteur
    <?php else : ?>
        Aucun rôle spécifié
    <?php endif; ?>
</p>



<?php

$content = ob_get_clean();
$title = "Détails film";
require "template.php";
