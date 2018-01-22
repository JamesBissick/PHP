<?php
$dsn ="mysql:dbname=nfactoryblog;host=localhost;charset=utf8";

$username = "root";

$password ="";

//$db = new PDO($dsn, $username, $password);

try {
    $db = new PDO($dsn, $username, $password);
    var_dump($db);
}
catch (PDOException $e){
    echo($e -> getMessage());
}

//unset($db);

$sql = "SELECT * FROM t_articles";

$resultat = $db -> query($sql);

while(($t_articles = $resultat -> fetch())) {
    echo html_entity_decode($t_articles['ARTCONTENU']);
}

//Requête d'insertion

///////////////////////////////////////////////////////////////////////

$db = new PDO($dsn, $username, $password);

$db -> setAttribute (
    PDO::ATTR_DEFAULT_FETCH_MODE,
    PDO::FETCH_ASSOC);

//Formatage pour un jeu de résultats
$resultat = $db -> query("SELECT *...");
$resultat -> setFetchMode(PDO::FETCH_ASSOC);
while(($t_articles = $resultat -> fetch())) {
    var_dump($t_articles);
}

//A chaque appel
$resultat = $db -> query("SELECT * ...");

