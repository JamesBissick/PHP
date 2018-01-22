<?php
$resultat = "<ul>";
for ($i = 2; $i <= 128; $i += 2) {
    if ($i % 5 == 0) {
        $resultat .= "<li>" . $i ;
        $resultat .= "<ul>";
        for ($e = 0; $e <= $i; $e += 3) {
            if ($e % 3 == 0) {
                $resultat .= "<li>" . $e . "</li>";
            }
        }
        $resultat .= "</ul></li>";
    }
}

echo($resultat); 
