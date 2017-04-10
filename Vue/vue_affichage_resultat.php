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
          <h2>Résultats sur le  : <?= $_GET['nom'] ?></h2>
      </header>

      <div class="panel panel-default">
        <div class="panel-body">
        <h2>Merci d'avoir effectué un quiz !</h2>
        <p>Voici la correction : </p>
        <main>
        <?php
          // Affichage des questions grâce à une boucle foreach
          foreach ($bonnes_reponses as $br)
          {
            $j++;
            $obj_br = new BReponse($br)
          ?>
            <br/>
            <p> Question n°<?= $j; ?> : <?= $obj_br->question(); ?> </p><br/>
          <?php
          // Je ne sais pas quoi mettre entre parenthèse dans la variable $_POST pour récupérer à chaque fois la réponse $_POST['1'], $_POST['2'], ...
          if ($_POST['reponse'][$j] == $obj_br->brep()) 
          {
            echo 'Vous avez choisis la bonne réponse ! :<br/>';
            echo $obj_br->brep();
            echo "<br/>";
            $score ++;

          }
          else
          {
            echo'Vous vous êtes tromper ! la bonne réponse était :<br/>';
            echo $obj_br->brep();
            echo "<br/>";
          }
          }
        ?>
        <br/>
        <p>Votre score est de : <?= ($score / 8)*100 ?> % de réussite</p><br/>
        </main>
        </div>
      </div>
      <footer class="well">
                Tout droits réservés
      </footer>
  </div>
  </body> 