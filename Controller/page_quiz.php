<?php

// Importations des classes et fonctions
require_once 'Modele/question.php';
require_once 'Modele/fonctions_quiz.php';
require_once 'Modele/reponse.php';

// Initialisation des variables
$questions = importation_questions($_GET['id_quiz']);

// Initialisation de la numérotation des questions
$j=0;


// Importation de la vue
require_once 'Vue/vue_quiz.php';
