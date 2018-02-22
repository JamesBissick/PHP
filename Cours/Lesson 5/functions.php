<?php
function calculerSurface($longeur, $largeur) {
    if ($longeur > 0 && $largeur > 0) {
        return $longeur * $largeur;
    }
    return false;
}

function calculerVolume($longeur, $largeur, $hauteur) {
    if ($longeur > 0 && $largeur > 0 && $hauteur > 0) {
        return ($longeur * $largeur) * $hauteur;
    }
    return false;
}
