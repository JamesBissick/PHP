<?php
$titre="<h1>Titre OKLM </h1>";
$message ="<p> Ceci est un message </p>";
$prenom = "Gertrude";
$nom .= " Brassein";
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>A la rencontre du PHP</title>
</head>
<body>
    

<?php

// Commentaire

/*
Commentaire
*/

$toto = "<h1>Coucou</h1>";
echo($toto);
echo($titre);
echo($message);
echo("<p>Bonjour \"$prenom\"</p>");
echo($nom);
?>
</body>
</html>
