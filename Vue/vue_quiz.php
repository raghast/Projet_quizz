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
          <h2>Vous avez selectionné le : <?= $_GET['nom_quiz'] ?></h2>
      </header>

      <div class="panel panel-default">
        <div class="panel-body">
        <h2>Merci d'avoir sélectionné ce quiz !</h2>
        <p>J'espère que vous arriverez à le finir sans faute !</p>
        <p>Bonne chance !</p></br>
        <p>Voici les questions :</p><br/>
        <main>
        <form action="?controller=affichage_resultat&&id_quiz=<?=$_GET['id_quiz']?>" method="POST">
        <?php
        // Boucle qui sélectionne les quizs un par un, mais il n'y en a qu'un
        foreach ($quizs as $quiz)
        {
          // Affichage des questions grâce à une boucle foreach
          foreach ($quiz->getQuestions() as $question)
          {
            $j++;
            // Initialisation de la numérotation des réponses
            $i=0;
            // Condition pour savoir quel type de question il s'agit
            if ($question->getType() == 1)
            {
            ?>
                <h4 style="color: rgba(147,70,23);"> Question n°<?= $j; ?> : <?= $question->getQuestion(); ?> </h4><br/>
                <p> Choix de la réponse : </p><br/>
                <?php
                // Affichage des reponses grâce à une boucle foreach
                foreach ($question->getReponses() as $reponse) 
                {
                  $i++;
                  ?>
                  <!-- formulaire de la réponse (type 1 = radio -> un seul choix) -->
                  <p><?= $i;?> : <label><input type="radio" name="reponse[<?= $j; ?>]" value="<?= $reponse->getReponse(); ?>"/> <?= $reponse->getReponse(); ?></label></p>
                  <?php
                }
            }
            elseif ($question->getType() == 2) 
            { 
            ?>
                  <h4 style="color: rgba(147,70,23);"> Question n°<?= $j; ?> : <?= $question->getQuestion(); ?> </h4><br/>
                  <p> Choix des réponses : </p><br/>  
                  <?php
                  // Affichage des reponses grâce à une boucle foreach
                  foreach ($question->getReponses() as $reponse) 
                  {
                  $i++;
                  ?>
                  <!-- formulaire de la réponse (type 2 = checkbox -> plusieurs choix) -->
                  <p><?= $i;?> : <label><input type="checkbox" name="reponse[<?= $reponse->getReponse(); ?>]" id="reponse[<?= $reponse->getReponse(); ?>]"> <?= $reponse->getReponse(); ?></label></p>
                  <?php
                  }
            }
            elseif ($question->getType() == 3) 
            {
            ?>
                  <h4 style="color: rgba(147,70,23);"> Question n°<?= $j; ?> : <?= $question->getQuestion(); ?> </h4><br/>
                  <p> Choix de la réponse : </p><br/>  
                  <!-- formulaire de la réponse (type 3 = nombre à saisir) -->
                  <p><input type="text" name="nombre[<?= $j; ?>]" id="nombre[<?= $j; ?>]"></p>
                  <?php
            }
            else 
            {
            ?>
                  <h4 style="color: rgba(147,70,23);"> Question n°<?= $j; ?> : <?= $question->getQuestion(); ?> </h4><br/>
                  <p> Ordre des réponses : </p><br/>  
                  <?php
                  // Affichage des reponses grâce à une boucle foreach
                  foreach ($question->getReponses() as $reponse) 
                  {
                  $i++;
                  ?>
                  <!-- formulaire de la réponse (type 4 = Chiffre pour l'ordre à saisir) -->
                  <p><label><input type="text" name="reponse[<?= $reponse->getReponse(); ?>]" id="reponse[<?= $reponse->getReponse(); ?>]"> <?= $reponse->getReponse(); ?></label></p>
                  <?php 
                  }
            }           
          ?>
            <br/>
          <?php
          }
        }
        ?>
        <input type="submit" name="valider" value="Valider !">
        </form><br/>
        </main>
        <a href="?controller=accueil_quiz">Retour au sommaire</a>
        </div>
      </div>
      <footer class="well">
                Tout droits réservés
      </footer>
  </div>
  </body> 
