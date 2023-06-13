<?php
session_start();
ob_start();
?>

<div id="header">
    <h1>Bienvenue sur le Wiki Cinéma !</h1>
    <p>Le Wiki Cinéma est une encyclopédie collaborative en ligne dédiée à l'univers du cinéma. Notre objectif est de fournir une source fiable et complète d'informations sur les films, les réalisateurs, les acteurs et tout ce qui concerne le septième art.</p>
</div>

<div id="content">
    <h2>Contenu du Wiki Cinéma</h2>
    <p>Notre wiki propose une vaste gamme de contenus, y compris :</p>

    <ol>
        <li>Fiches de films : Explorez des fiches détaillées sur des milliers de films, avec des résumés, des informations sur les acteurs, les réalisateurs, les critiques et bien plus encore. Vous pouvez également contribuer en ajoutant de nouvelles fiches ou en mettant à jour des informations existantes.</li>
        <li>Biographies de réalisateurs et d'acteurs : Découvrez la vie et la carrière des réalisateurs et acteurs les plus célèbres. Apprenez-en plus sur leur filmographie, leurs récompenses, leurs influences et leur style distinctif.</li>
        <li>Genres cinématographiques : Plongez dans les différents genres cinématographiques, tels que l'action, la comédie, le drame, la science-fiction, l'horreur et bien d'autres. Explorez les caractéristiques de chaque genre et découvrez les films emblématiques qui les représentent.</li>
        <li>Listes et classements : Consultez nos listes et classements pour découvrir les meilleurs films de tous les temps, les performances les plus mémorables, les scènes cultes et bien plus encore. Partagez vos propres listes et opinions avec la communauté.</li>
        <li>Nouveautés et actualités : Restez à jour avec les dernières nouvelles du monde du cinéma, y compris les sorties de films à venir, les festivals, les remises de prix et les annonces de projets excitants. Soyez le premier à connaître les tendances et les développements de l'industrie cinématographique.</li>
    </ol>
</div>

<div id="footer">
    <h3>Rejoignez notre communauté</h3>
    <p>Nous vous invitons à rejoindre notre communauté passionnée de cinéma en devenant un contributeur du Wiki Cinéma. Que vous souhaitiez ajouter de nouvelles informations, corriger des erreurs ou simplement partager votre amour du cinéma, votre contribution est la bienvenue.</p>
    <p>Explorez, apprenez et plongez dans l'univers magique du cinéma avec le Wiki Cinéma !</p>
</div>


<?php
$content = ob_get_clean();
$title = "home";
require "template.php";
