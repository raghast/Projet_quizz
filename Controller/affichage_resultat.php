<?php

require_once 'Modele/fonctions_quiz.php';
require_once 'Modele/bonne_reponse.php';

// Initialisation des variables
$bonnes_reponses = importation_br($_GET['id_quiz']);

// Initialisation de la numérotation des questions
$j=0;

// Initialisation de la variable pour le score
$score=0;

// Importation de la vue
require_once 'Vue/vue_affichage_resultat.php';
