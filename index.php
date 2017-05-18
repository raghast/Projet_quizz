<?php

require_once 'Utils/init.php';

// Variable controller avec l'acceuil du quizz comme valeur par défault
$controller = 'accueil_quiz';

if (!empty($_GET['controller'])) {
    $controller = $_GET['controller'];
}

// Création du chemin à partir de la variable GET précédente
$path = 'Controller/'.$controller.'.php';

// Si le chemin existe, lien vers celui-ci sinon lien vers la page error 404
if (file_exists($path)) 
{
    require_once $path;
} 
else 
{
    require_once 'Vue/404.php';
}

