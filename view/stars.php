<?php
ob_start();
?>

<p class="uk-label uk-label-warning">Il y a <?= $requete->rowCount() ?> stars</p>

<div class="star-container">
    <?php
    foreach ($requete->fetchAll() as $personne) { ?>
        <a href="index.php?action=personneDetails&id=<?= $personne["idPersonne"] ?>">
            <div class="star-card">
                <p><?= $personne["nom"] ?></p>
                <img class="actor-affiche" src="public/upload/561836.jpg-c_310_420_x-f_jpg-q_x-xxyxx.jpg">
            </div>
        </a>
    <?php } ?>
</div>



<?php

$content = ob_get_clean();
$title = "start";
require "template.php";
