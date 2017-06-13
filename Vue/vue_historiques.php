<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <!-- Latest compiled and minified CSS -->
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
              integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
              crossorigin="anonymous">
    <!-- Optional theme -->
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
              integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp"
              crossorigin="anonymous">
    <title>Quiz en ligne !</title>
  </head>  
  <body>
  <div class="container">
    <header class="jumbotron">
       <h1>Historique de vos quizs en ligne !</h1></br></br>
       <h2>Voici vos résultats :</h2>
    </header>

    <div class="panel panel-default">
        <div class="panel-body">
        <h2>Merci d'avoir effectué ces quizs !</h2>
        <p>Vous trouvez vos réponses ainsi que les réponses disponible dont les bonnes en gras</p>
        <main>
		<?php

		// Importations des classes et fonctions
		require_once 'Modele/quiz.php';
		require_once 'Modele/question.php';
		require_once 'Modele/fonctions_quiz.php';
		require_once 'Modele/reponse.php';
		foreach ($quizs_util as $quiz_serial) 
		{
			$nb_quiz++;
			// Déserialisation du quiz 
			$quiz = unserialize($quiz_serial['Contenu_Util']);
			$questions = [];
			// Importation de toutes les questions et réponses possibles du quiz effectué par l'utilisateur
			$all_quiz = importation_tout(array_keys($quiz)[0]);
			$quiz_complet = [];
			// Transformation en architecture objet
			$quiz_complet = range_tableau($all_quiz, $quiz_complet);
			$key=1;
			foreach ($quiz_complet as $quizz) 
			{		
			?>
				<h3 style="color: rgba(36, 143, 179);">Résultats sur votre quiz n°<?= $nb_quiz; ?> : <?= $quizz->getNom(); ?></h3>
				<?php
				foreach ($quizz->getQuestions() as $question) 
				{
				?>
					<h4 style="color: rgba(147,70,23);">Question n°<?= $key ?> : <?= $question->getQuestion();?></h4>
					<?php
					// Condition pour trouver le type de question
					if ($question->getType() == 1) 
					{
						// Affiche les réponses de l'utilisateur
						hist_affichage_reps_util($quiz, $quizz, $question);
						// Affiche toutes les réponses (en gras les justes)
						hist_affichage_all_reps($question);
					}
					elseif ($question->getType() == 2) 
					{
						// Affiche les réponses de l'utilisateur
						hist_affichage_reps_util($quiz, $quizz, $question);
						// Affiche toutes les réponses (en gras les justes)
						hist_affichage_all_reps($question);						
					}
					elseif ($question->getType() == 3) 
					{
						// Affiche les réponses de l'utilisateur
						hist_affichage_reps_util($quiz, $quizz, $question);
						// Affiche la bonne réponse
						hist_affichage_all_reps($question);
					}
					else 
					{
						// Affiche les réponses de l'utilisateur
						hist_affichage_reps_util($quiz, $quizz, $question);
						// Affiche le bon ordre (Pas de fonction car cas différent des autres types de question)
						foreach ($question->getReponses() as $rep)
						{
							echo $rep->getState() . ' - ' . $rep->getReponse() . '<br>';
						}
					}
					$key++;
				}
			}
			?>
			<p style="font-size: 1.1em";>Votre score été de : <strong style="color: red";><?= $quiz_serial['Score_util'] ?> % de réussite</strong></p>
			<?php
		}
		?>
		</main>
        <a href="?controller=accueil_quiz">Retour au sommaire</a><br/>
        </div>
    </div>
    <footer class="well">
        Tout droits réservés
    </footer>
  </div>
</body>