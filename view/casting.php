<?php
ob_start();
?>

<div id="divCasting">
    <p id="pCasting"> Il y a <?= $requete->rowCount() ?> castings </p>

    <table id="tCasting">
        <thread>
            <tr>
                <th id="thCasting">Film</th>
                <th id="thCasting"> Acteur </th>
                <th id="thCasting">Role</th>
            </tr>
        </thread>

        <tbody>
            <?php
            foreach ($requete->fetchAll() as $casting) { ?>
                <tr>
                    <td id="tdCasting"><a id="aCasting" href="index.php?action=filmDetails&id=<?= $casting["idFilm"] ?>"><?= $casting["titre"] ?></a></td>
                    <td id="tdCasting"><a id="aCasting" href="index.php?action=personneDetails&id=<?= $casting["idPersonne"] ?>"><?= $casting["nom"] ?></a></td>
                    <td id="tdCasting"><?= $casting["roleNom"] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php

$content = ob_get_clean();
$title = "Casting";
require "template.php";
