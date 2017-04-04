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
          <h2>Vous avez selectionné le : <?= $_GET['nom'] ?></h2>
      </header>

      <div class="panel panel-default">
        <div class="panel-body">
        <h2>Merci d'avoir sélectionné ce quiz !</h2>
        <p>J'espère que vous arriverez à le finir sans faute !</p>
        <p>Bonne chance !</p></br>
        <p>Voici les questions :</p>
        <main>
        <?php
          // Affichage des questions grâce à une boucle foreach
          foreach ($questions as $quest)
          {
            $j++;
            // Initialisation de la numérotation des réponses
            $i=0;
            $obj_question = new Question($quest)
          ?>
            <p> Question n°<?= $j; ?> : <?= $obj_question->question(); ?> </p>
            <p> Choix de la réponse : </p><br/> 
            <?php
               $reponses = importation_reponses($j);
               // Affichage des reponses grâce à une boucle foreach
               foreach ($reponses as $rep) 
               {
                 $i++;
                 $obj_reponse = new Reponse($rep);
            ?>
                <p><?= $i . ' : ' . $obj_reponse->reponse(); ?></p>
            <?php
               }
            ?>
        <?php
          }
        ?>
        </main>
        </div>
      </div>
      <footer class="well">
                Tout droits réservés
      </footer>
  </div>
  </body> 