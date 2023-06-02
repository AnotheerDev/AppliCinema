<?php
ob_start();
?>

<p class="uk-label uk-label-warning">Il y a <?= $requete->rowCount() ?> stars</p>

<table class="uk-label uk-label-stripped">
    <thead>
        <tr>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($requete->fetchAll() as $personne) { ?>
            <tr>
                <td><a href="index.php?action=personneDetails&id=<?= $personne["idPersonne"] ?>"><?= $personne["nom"] ?></a></td>
            </tr>
        <?php } ?>
    </tbody>
</table>



<?php

$content = ob_get_clean();
$title = "start";
require "template.php";
