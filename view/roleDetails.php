<?php
ob_start();
?>

<?php if (!empty($castings)) : ?>
    <p> Voici tous les acteurs ayant joué le rôle de : <?= $castings[0]['nom'] ?></p>
<?php else : ?>
    <p>Aucun acteur n'a joué ce rôle.</p>
<?php endif; ?>

<?php
foreach ($castings as $casting) { ?>
    <a href="index.php?action=personneDetails&id=<?= $casting["idPersonne"] ?>">
        <p><?= $casting["actor"] ?></p>
    </a>
<?php } ?>


<?php

$content = ob_get_clean();
$title = "Rôle détails";
require "template.php";
