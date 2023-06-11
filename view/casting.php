<?php
ob_start();
?>

<p> Il y a <?= $requete->rowCount() ?> castings </p>

<table>
    <thread>
        <tr>
            <th>Film</th>
            <th> Acteur </th>
            <th>Role</th>
        </tr>
    </thread>

    <tbody>
        <?php
        foreach ($requete->fetchAll() as $casting) { ?>
            <tr>
                <td><?= $casting["titre"] ?></td>
                <td><a href="index.php?action=personneDetails&id=<?= $casting["idPersonne"] ?>"><?= $casting["nom"] ?></a></td>
                <td><?= $casting["roleNom"] ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>


<?php

$content = ob_get_clean();
$title = "Casting";
require "template.php";
