<?php

// Importations des classes et fonctions
require_once 'Modele/quiz.php';
require_once 'Modele/question.php';
require_once 'Modele/fonctions_quiz.php';
require_once 'Modele/reponse.php';

verif_presence_var();
// Fonction de vérification de la page (pour la variable $_GET['id_quiz'], $_GET['nom_quiz'])
check_variables($_GET['id_quiz'], $_GET['nom_quiz']);

// Même système que pour le controller page_quiz mais importation_br importe un quiz, ses questions et la bonne réponse pour chaque question
$bonnes_rep = importation_br($_GET['id_quiz']);
// On importe aussi tout le quiz dans une autre variable pour l'étape d'aprés
$quiz_all = importation_tout($_GET['id_quiz']);
$all_rep = [];
$quiz_br = [];
$historique = [];
$j = 0;

// Fonction pour créer les tableaux d'objets
$quiz_br = range_tableau($bonnes_rep, $quiz_br);
$all_rep = range_tableau($quiz_all, $all_rep);

foreach ($all_rep as $quizz)
{
	// Création du tableau ou l'on stocké les réponses de l'utilisateur à mettre en BDD
	$historique[$quizz->getId()] = [];
    // Affichage des questions grâce à une boucle foreach
    foreach ($quizz->getQuestions() as $question)
    {
    	//Création d'un tableau d'ID des questions dans le tableau précédent
     	$historique[$quizz->getId()][$question->getId()] = [];
     	$j ++;         
        // Condition pour savoir quel est le type de la question
        if ($question->getType() == 1 AND isset($_POST['reponse'][$j])) 
        {   
        	// On assigne les réponses de l'utilisateur à l'ID de question correspondante   
            $historique[$quizz->getId()][$question->getId()][$j] = $_POST['reponse'][$j];      
        }
    	elseif ($question->getType() == 2) 
        {
            foreach ($question->getReponses() as $reponse) 
            {
                if (isset($_POST['reponse'][$reponse->getReponse()]))
                {
                	$historique[$quizz->getId()][$question->getId()][$reponse->getId()] = $reponse->getReponse();
                }                           
            }          
        }
        elseif ($question->getType() == 3 AND isset($_POST['nombre'][$j])) 
        {
        	$historique[$quizz->getId()][$question->getId()][$j] = htmlspecialchars($_POST['nombre'][$j]);           
        }
        else
        {   
        	foreach ($question->getReponses() as $reponse) 
        	{                  
                if (isset($_POST['reponse'][$reponse->getReponse()])) 
                {
                	// Pareil qu'au dessus mais on rajoute l'ordre choisi devant la réponse
                    $historique[$quizz->getId()][$question->getId()][$reponse->getId()] = htmlspecialchars($_POST['reponse'][$reponse->getReponse()]) . ' - ' . $reponse->getReponse();
                }                
            }                                            
        }
    }
}
//Préparation de la variable de session et du tableau des réponses sérialisées à stocker en BDD
$session_id = session_id();
$hist_serial = serialize($historique);

// Initialisation de la numérotation des questions
$j=0;

// Initialisation de la variable pour le score
$score=0;

// Importation de la vue
require_once 'Vue/vue_affichage_resultat.php';
