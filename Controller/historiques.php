<?php

// Importations des classes et fonctions
require_once 'Modele/quiz.php';
require_once 'Modele/question.php';
require_once 'Modele/fonctions_quiz.php';
require_once 'Modele/reponse.php';

$quizs_util = importation_quizs_util(session_id());
$nb_quiz=0;

require_once 'Vue/vue_historiques.php';