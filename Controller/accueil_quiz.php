<?php

// Importations des classes
require_once 'Modele/quiz.php';
require_once 'Modele/quiz_manager.php';

// Initialisation des variables
$db = new PDO('mysql:host=localhost;dbname=projet_quiz', 'root', '');
$manager = new QuizManager($db);

// Initialisation de la numérotation des quiz
$j=0;

// Importation de la vue
require_once 'Vue/vue_accueil_quiz.php';



