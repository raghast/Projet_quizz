<?php

// Importations des classes et fonctions
require_once 'Modele/quiz.php';
require_once 'Modele/question.php';
require_once 'Modele/fonctions_quiz.php';
require_once 'Modele/reponse.php';

// Remplissage de la variable $quizs qui contient le Quiz, ses questions et ses réponses

$datas = importation_tout($_GET['id_quiz']);
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


// Importation de la vue
require_once 'Vue/vue_quiz.php';
