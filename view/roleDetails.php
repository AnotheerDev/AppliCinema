<?php
ob_start();
?>

<?php if (!empty($castings)) : ?>
    <h3> Voici tous les acteurs ayant joué le rôle de : <?= $castings[0]['nom'] ?></h3>
<?php else : ?>
    <h3>Aucun acteur n'a joué ce rôle.</h3>
<?php endif; ?>

<div class="star-container">
    <?php
    foreach ($castings as $casting) { ?>
        <a href="index.php?action=personneDetails&id=<?= $casting["idPersonne"] ?>">
            <div class="star-card">
                <p><?= $casting["actor"] ?></p>
                <img class="actor-affiche" src="public/upload/561836.jpg-c_310_420_x-f_jpg-q_x-xxyxx.jpg">
            </div>
        </a>
    <?php } ?>
</div>

<?php

$content = ob_get_clean();
$title = "Rôle détails";
require "template.php";
