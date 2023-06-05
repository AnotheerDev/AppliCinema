<?php
ob_start();
?>

<h2><?= $genre['nom'] ?></h2>

<h3>Films du genre <?= $genre['nom'] ?></h3>
<ul>
    <?php
    foreach ($filmIds as $filmId) {
        $requeteFilm = $pdo->prepare("
            SELECT *
            FROM film
            WHERE idFilm = :filmId
        ");
        $requeteFilm->bindParam(':filmId', $filmId, \PDO::PARAM_INT);
        $requeteFilm->execute();
        $film = $requeteFilm->fetch();

        // Afficher les détails du film
        echo "<li>" . $film['titre'] . "</li>";
    }
    ?>
</ul>

<?php
$content = ob_get_clean();
$title = "Détails du genre";
require "template.php";
