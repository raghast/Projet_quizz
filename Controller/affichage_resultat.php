<?php

// Importations des classes et fonctions
require_once 'Modele/quiz.php';
require_once 'Modele/question.php';
require_once 'Modele/fonctions_quiz.php';
require_once 'Modele/reponse.php';


// Fonctions de vérification de la page (pour la variable $_GET['id_quiz'], et Is_autorized pour savoir si l'utilisateur à déjà fais le quiz)
check_variable();
check_id($_GET['id_quiz']);
Is_autorized($_GET['id_quiz']);

// Même système que pour le controller page_quiz mais importation_br importe un quiz, ses questions et la bonne réponse pour chaque question
$datas = importation_br($_GET['id_quiz']);
$quizs = [];
foreach ($datas as $data) 
{
	$quiz = new Quiz($data);
	if (isset($quizs[$quiz->getId()])) 
	{
       $quizs[$quiz->getId()]->fusion($quiz);
    } else 
    {
       $quizs[$quiz->getId()] = $quiz;
    }
}

// Initialisation de la numérotation des questions
$j=0;

// Initialisation de la variable pour le score
$score=0;

// Importation de la vue
require_once 'Vue/vue_affichage_resultat.php';
