<?php

// Initialisation du projet (Connection bdd, espace admin et autres)
require_once 'Utils/init.php';

// Test de la faille CRSF - Creation d'un token dans la variable SESSION. Mais je pense que ce n'est pas bon, je n'ai pas réussit à le faire marcher comme expliqué dans le cours.
if (empty($_SESSION['token']))
{
	$_SESSION['token'] = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
}

// Première variable Get : Selection du dossier dans celui des controllers
$controller = 'blog';

if (!empty($_GET['controller'])) {
    $controller = $_GET['controller'];
}

// Deuxième variable Get : Selection d'un fichier php controller dans le dossier sélectionné précedemment
$action = 'acceuil_blog';

if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

// Création du chemin à partir des 2 variables GET précédentes
$path = 'Controller/'.$controller.'/'.$action.'.php';

// Si le chemin existe, lien vers celui-ci sinon lien vers la page error 404
if (file_exists($path)) 
{
    require_once $path;
} 
else 
{
    require_once 'Vue/404.php';
}

