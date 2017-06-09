<?php

// Importations des classes et fonctions
require_once 'Modele/quiz.php';
require_once 'Modele/question.php';
require_once 'Modele/fonctions_quiz.php';
require_once 'Modele/reponse.php';

// Fonction de vérification de la page (pour la variable $_GET['id_quiz'] et $_GET['nom_quiz'])

check_variables($_GET['id_quiz'], $_GET['nom_quiz']);

// Remplissage de la variable $quizs qui contient le Quiz, ses questions et ses réponses

$datas = importation_tout($_GET['id_quiz']); // Importation dans un tableau de tableaux $datas (chaque sous tableau contient le nom du quiz la question et une réponse d'où une redondance)
$quizs = [];
// Appel la fonction qui permet de ranger tous les tableaux datas en un tableau de d'objets dans d'autres objets
$quizs = range_tableau($datas, $quizs);

// Initialisation de la numérotation des questions
$j=0;


// Importation de la vue
require_once 'Vue/vue_quiz.php';


