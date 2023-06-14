<?php
ob_start();
?>

<style>
    .genre-details {
        background-color: #f7f7f7;
        padding: 20px;
        border-radius: 5px;
        margin-top: 20px;
    }

    h2 {
        font-size: 24px;
        margin-bottom: 10px;
    }

    h3 {
        font-size: 20px;
        margin-bottom: 10px;
    }

    ul {
        list-style-type: none;
        padding-left: 0;
    }

    li {
        font-size: 18px;
        margin-bottom: 5px;
    }
</style>

<div class="genre-details">
    <h2><?= $genre['nom'] ?></h2>

    <h3>Films du genre <?= $genre['nom'] ?> :</h3>
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
            // echo "<li>" . $film['titre'] . "</li>";
            echo "<li><a href='index.php?action=filmDetails&id=" . $film["idFilm"] . "'>" . $film["titre"] . "</a></li>";

        }
        ?>
    </ul>
</div>

<?php
$content = ob_get_clean();
$title = "Détails du genre";
require "template.php";
?>