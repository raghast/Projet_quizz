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
        <h2>Résultats sur le  : <?= $quiz->getNom(); ?></h2>
      </header>

      <div class="panel panel-default">
        <div class="panel-body">
        <h2>Merci d'avoir effectué ce quiz !</h2>
        <p>Voici la correction : </p>
        <main>
          <?php
          // Boucle qui sélectionne les quizs un par un, mais il n'y en a qu'un
          foreach ($quizs as $quiz)
          {
              // Affichage des questions grâce à une boucle foreach
              foreach ($quiz->getQuestions() as $question)
              {
                $j ++;
                // Condition pour savoir quel est le type de la question
                if ($question->getType() == 1) 
                {
                ?>
                <h4 style="color: rgba(147,70,23);"> Question n°<?= $j; ?> : <?= $question->getQuestion(); ?> </h4><br/>
                <?php
                foreach ($question->getReponses() as $rep) 
                {                 
                  // Condition pour voir si une réponse a été sélectionnée
                  if (!isset($_POST['reponse'][$j])) 
                  {
                    echo 'Vous vous êtes tromper !<br/>';
                    echo 'La bonne réponse était : <strong>' . $rep->getReponse() . '</strong>';
                    echo "<br/>";
                  }
                  // Condition pour vérifier si la réponse est juste
                  elseif ($_POST['reponse'][$j] == $rep->getReponse()) 
                  { 
                    echo 'Vous avez eu juste !<br/>';
                    echo 'Bonne réponse : <strong>' . $rep->getReponse() . '</strong>';
                    echo "<br/>";
                    // Incrémentation du score si la réponse est juste
                    $score ++;
                  }
                  else
                  {
                    echo 'Vous vous êtes tromper !<br/>';
                    echo 'La bonne réponse était : <strong>' . $rep->getReponse() . '</strong>';
                    echo "<br/>";
                }
                }
                else
                {
                ?>
                  <h4 style="color: rgba(147,70,23);"> Question n°<?= $j; ?> : <?= $question->getQuestion(); ?> </h4><br/>
                  <?php
                  $reponses_fausses = 0;
                  $bonnes_reponses = [];
                  foreach ($question->getReponses() as $reponse) 
                  {                    
                    // Création d'un tableau bonnes_réponses pour stocker les bonnes réponses
                    $bonnes_reponses[$reponse->getId()] = $reponse->getReponse();
                    // Si une seule bonne réponse n'a pas été coché alors l'utilisateur a faux à toute la question
                    if (!isset($_POST['reponse'][$reponse->getReponse()]))
                    { 
                      $reponses_fausses ++;
                    }                                  
                  }
                  if ($reponses_fausses == 0) 
                  {
                    echo 'Vous avez eu juste !<br/>';
                    echo 'Bonnes réponses : <strong>';
                    // Boucle qui affiche toutes les bonnes réponses
                    foreach ($bonnes_reponses as $br){ echo $br . ' '; }
                    echo '</strong>';
                    echo "<br/>";
                    $score ++;
                  }
                  else
                  {
                    echo 'Vous vous êtes tromper !<br/>';
                    echo 'Les bonnes réponses étaient : <strong>';
                    // Boucle qui affiche toutes les bonnes réponses
                    foreach ($bonnes_reponses as $br){ echo $br . ' '; }
                    echo '</strong>';
                    echo "<br/>";
                  }
                }                                            
              }
          }
          // Attribution d'une valeur à $_SESSION['Quiz_done'][$_GET['id_quiz']] pour éviter que l'utilisateur refasse le même quiz 2 fois (voir fonction Is_autorized)
          $_SESSION['Quiz_done'][$_GET['id_quiz']]=$_GET['id_quiz'];
          ?>
            <br/>
            <p style="font-size: 1.5em";>Votre score est de : <strong style="color: red";><?= ceil(($score / $j)*100) ?> % de réussite</strong></p>
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
