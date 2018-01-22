<header>
<ul>
    <li><a href="index.php?page=accueil">Accueil</a></li>
    <li><a href="index.php?page=inscription">Inscription</a></li>
<?php
    if ($_SESSION['login'] == 0 || !isset($_SESSION['login']))
        echo ("<li><a href=\"index.php?page=login\">Login</a></li>");
    else
        echo ("<li><a href=\"index.php?page=logout\">Logout</a></li>");
?>


</ul>
</header>