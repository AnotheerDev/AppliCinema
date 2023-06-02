<?php
ob_start();
?>

<table class="uk-label uk-label-stripped">
    <thead>
        <tr>
            <th>TITRE</th>
            <th>DATE DE SORTIE</th>
            <th>DUREE</th>
            <th>SINOPSIS</th>
            <th>NOTE</th>
            <th>REALISATEUR</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($requete->fetchAll() as $film) { ?>
            <tr>
                <td><?= $film["titre"] ?></td>
                <td><?= $film["dateSortie"] ?></td>
                <td><?= $film["duree"] ?></td>
                <td><?= $film["synopsis"] ?></td>
                <td><?= $film["note"] ?></td>
                <td><?= $film["idRealisateur"] ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<?php

$content = ob_get_clean();
$title = "Détails film";
require "template.php";
