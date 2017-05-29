<?php

// Importations des classes et fonctions
require_once 'Modele/quiz.php';
require_once 'Modele/question.php';
require_once 'Modele/fonctions_quiz.php';
require_once 'Modele/reponse.php';

// Fonctions de vérification de la page (pour la variable $_GET['id_quiz'])

check_variable();
check_id($_GET['id_quiz']);

// Remplissage de la variable $quizs qui contient le Quiz, ses questions et ses réponses

$datas = importation_tout($_GET['id_quiz']); // Importation dans un tableau de tableaux $datas (chaque sous tableau contient le nom du quiz la question et une réponse d'où une redondance)
$quizs = [];
// Boucle foreach qui va parcourir $datas pour ajouter à $quizs un nom de quiz et ses question
foreach ($datas as $data) 
{
    $quiz = new Quiz($data);
    if (isset($quizs[$quiz->getId()])) 
    {
    	// Permet de fusionner le nom de quiz et son id s'il éxiste déjà évitant ainsi la redondance lors de l'ajoùt d'une question
        $quizs[$quiz->getId()]->fusion($quiz);
    } else 
    {
    	// Ajoute un nouveau nom de quiz et son id
        $quizs[$quiz->getId()] = $quiz;
    }
}

// Initialisation de la numérotation des questions
$j=0;


// Importation de la vue
require_once 'Vue/vue_quiz.php';
