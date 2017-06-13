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
        <h1>Faites un Quiz en ligne !</h1></br></br>
        <h2>Résultats sur le  : <?= $_GET['nom_quiz'];?></h2>
      </header>

      <div class="panel panel-default">
        <div class="panel-body">
          <h2>Merci d'avoir effectué ce quiz !</h2>
          <p>Voici la correction : </p>
          <p>Les réponses en orange sont les bonnes réponses.</p>
          <main>
          <?php
          // Boucle qui sélectionne les quizs un par un, mais il n'y en a qu'un
          foreach ($all_rep as $quiz)
          {             
              // Affichage des questions grâce à une boucle foreach
              foreach ($quiz->getQuestions() as $question)
              {              
                $j ++;
                ?>
                <h4 style="color: rgba(147,70,23);"> Question n°<?= $j; ?> : <?= $question->getQuestion(); ?> </h4><br/>
                <?php
                // Condition pour savoir quel est le type de la question
                if ($question->getType() == 1) 
                {
                  foreach ($question->getReponses() as $rep) 
                  {
                    if (!isset($_POST['reponse'][$j])) 
                    {
                        // Reponse fausse -> $message = 0
                        $message = 0;
                    }
                    elseif ($_POST['reponse'][$j] == $rep->getReponse() AND $rep->getState() == 1) 
                    { 
                        // Reponse juste -> $message = 1
                        $message = 1;
                    }
                    else
                    {
                    // Reponse fausse -> $message = 0
                    $message = 0;
                    }
                  }
                  // Affichage du message + Incrémentation du score en cas de bonne réponse + Affichage des réponses(les bonnes en gras)          
                  $score = affichage_message($message, $score);
                  affichage_reponses($question);
                }
                // Condition pour savoir quel est le type de la question
                elseif ($question->getType() == 2) 
                {
                  $message = 1; 
                  foreach ($question->getReponses() as $rep) 
                  {  
                      // Si une seule bonne réponse n'a pas été coché ou une question fausse a été coché alors l'utilisateur a faux à toute la question
                      if (!isset($_POST['reponse'][$rep->getReponse()]) AND $rep->getState() == 1)
                      { 
                          $message = 0;
                      }
                      elseif (isset($_POST['reponse'][$rep->getReponse()]) AND $rep->getState() == 0) 
                      {
                          $message = 0;
                      }
                  }
                  // Affichage du message + Incrémentation du score en cas de bonne réponse + Affichage des réponses(les bonnes en gras)                              
                  $score = affichage_message($message, $score);
                  affichage_reponses($question);
                }
                // Condition pour savoir quel est le type de la question
                elseif ($question->getType() == 3) 
                {
                  foreach ($question->getReponses() as $rep) 
                  {
                    if ($_POST['nombre'][$j] == $rep->getReponse() AND $rep->getState() == 1) 
                    { 
                        // Reponse juste -> $message = 1
                        $message = 1;
                    }
                    else
                    {
                        // Reponse fausse -> $message = 0
                        $message = 0;
                    }
                   }
                   // Affichage du message + Incrémentation du score en cas de bonne réponse + Affichage des réponses(les bonnes en gras)                           
                    $score = affichage_message($message, $score);
                    affichage_reponses($question);
                }
                // Dernier type de question par élimination
                else
                { 
                  $message = 1;
                  foreach ($question->getReponses() as $rep) 
                  {
                    // Si un ordre ne correspond pas alors toute la question est fausse                    
                    if (!($rep->getState() == $_POST['reponse'][$rep->getReponse()])) 
                    {
                        $message = 0;
                    }
                  }
                  // Affichage du message + Incrémentation du score en cas de bonne réponse + Affichage des réponses(le bon ordre)
                  $score = affichage_message($message, $score);
                  affichage_reponses_4($question);                                               
                }                                            
              }
          }
          // Calcul du score sur le quiz
          $score_calcul = ceil(($score / $j)*100);
          // Envoi du quiz sérialisé + son score dans la BDD avec l'identifiant session de l'utilisateur
          range_hist_bdd($hist_serial, $score_calcul, $session_id);
          ?>
          <p style="font-size: 1.5em";>Votre score est de : <strong style="color: red";><?= $score_calcul ?> % de réussite</strong></p>
          <br/>
        </main>
        <a href="?controller=accueil_quiz">Retour au sommaire</a><br/>
        </div>
      </div>
      <footer class="well">
        Tout droits réservés
      </footer>
  </div>
  </body>
