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
          <h2>Liste des Quiz</h2>
      </header>

      <div class="panel panel-default">
        <div class="panel-body">
        <h2>Bienvenue sur mon outil de quiz en ligne !</h2>
        <p>Prenez le temps de faire ça bien !</p>
        <p>Cela risque d'être difficile</p></br>
        <p>Voici la liste des Quiz disponible :</p>
        <main>
        <?php
          // Affichage des Quiz grâce à une boucle foreach
          foreach ($all_quiz as $quiz) 
            {
                $j++;
                $obj_quiz = new Quiz($quiz);
        ?>
        <p> Quiz n°<?= $j ?> : <a href="?controller=page_quiz&&nom=<?= $obj_quiz->nom();?>&&id_quiz=<?= $obj_quiz->id();?>"><?= $obj_quiz->nom(); ?></a> <p>
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
