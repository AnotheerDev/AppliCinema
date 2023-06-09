<?php
ob_start();
?>

<p> Il y a <?= $requete->rowCount() ?> castings </p>

<table>
    <thread>
        <tr>
            <th>Film</th>
            <th> Prenom </th>
            <th> Nom </th>
            <th>Role</th>
        </tr>
    </thread>

    <tbody>
        <?php
        foreach ($requete->fetchAll() as $casting) { ?>
            <tr>
                <td><?= $casting["titre"] ?></td>
                <td><?= $casting["acteurNom"] ?></td>
                <td><?= $casting["acteurPrenom"] ?></td>
                <td><?= $casting["roleNom"] ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>


<?php

$content = ob_get_clean();
$title = "Casting";
require "template.php";
