<?php

// Importations des classes
require_once 'Modele/quiz.php';
require_once 'Modele/fonctions_quiz.php';

// Initialisation des noms et id des quizs

$all_quiz = importation_quiz();

// Initialisation de la numérotation des quiz
$j=0;

// Importation de la vue
require_once 'Vue/vue_accueil_quiz.php';



