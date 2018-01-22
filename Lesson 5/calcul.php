<?php
include "functions.php";


$longueur = $_POST["longueur"];
$largeur = $_POST["largeur"];
$hauteur = $_POST["hauteur"];

/*$toto = "la longueur est de $longueur et la largeur de $largeur";
echo($toto);*/

if(calculerSurface($longueur,$largeur)) {
    echo("La surface est de : " . calculerSurface($longueur, $largeur));
} else {
    echo("Verifie tes données...");
}

if(calculerVolume($longueur,$largeur,$hauteur)) {
    echo("<br>Le volume est de : " . calculerVolume($longueur, $largeur, $hauteur));
} else {
    echo("Verifie tes données...");
}