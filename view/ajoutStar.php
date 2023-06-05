<?php
ob_start();
?>
<h3>Ajouter une nouvelle star</h3>

<form method="post" action="index.php?action=ajoutStar">
    <div>
        <label for="nom">Nom :</label>
        <input type="text" name="nom" id="nom" required>
    </div>
    <div>
        <label for="prenom">Prénom :</label>
        <input type="text" name="prenom" id="prenom" required>
    </div>
    <div>
        <label for="sexe">Sexe :</label>
        <select name="sexe" id="sexe" required>
            <option value="masculin">Masculin</option>
            <option value="feminin">Féminin</option>
        </select>
    </div>
    <div>
        <label for="date_naissance">Date de naissance :</label>
        <input type="date" name="date_naissance" id="date_naissance" required>
    </div>
    <div>
        <input type="checkbox" name="acteur" id="acteur">
        <label for="acteur">Acteur</label>
    </div>
    <div>
        <input type="checkbox" name="realisateur" id="realisateur">
        <label for="realisateur">Réalisateur</label>
    </div>
    <div>
        <input type="submit" value="Ajouter">
    </div>
</form>




<?php

$content = ob_get_clean();
$title = "Ajout Star";
require "template.php";
