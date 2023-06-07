<?php
ob_start();
?>


<p>Ajouter un nouveau film</p>

<form action="index.php?action=addFilm" method="post">
    <div>
        <label for="titre"></label>
        <input type="text" name="titre" maxlength="50" placeholder="Titre" required>
    </div>
    <div>
        <label for="date_sortie"></label>
        <input type="date" name="dateSortie" placeholder="Date de Sortie">
    </div>
    <div>
        <label for="synopsis"></label>
        <textarea name="synopsis" maxlength="500" placeholder="Synopsis"></textarea>
    </div>
    <div>
        <label for="duree"></label>
        <input type="number" name="duree" placeholder="Durée">
    </div>
    <div>
        <label for="note"></label>
        <input type="number" name="note" placeholder="Note">
    </div>
    <div>
        <select name="idRealisateur">
            <?php
            // faire une requete pour avoir le nom et prenom du réal
            $requeteRealisateur = $pdo->query ("SELECT r.idRealisateur, p.nom, p.prenom
                                                FROM realisateur r
                                                JOIN personne p ON r.idPersonne = p.idPersonne;");
            foreach ($requeteRealisateur->fetchAll() as $realisateur) { ?>
                <option value="<?= $realisateur["idRealisateur"] ?>">
                    <?= $realisateur["idRealisateur"] ?><?= $realisateur["nom"] ?> <?= $realisateur["prenom"] ?>
                </option>
            <?php } ?>
        </select>
    </div>
    <div>
        <input type="submit" name="submit" value="Ajouter">
    </div>
</form>


<?php

$content = ob_get_clean();
$title = "Ajout Film";
require "template.php";
