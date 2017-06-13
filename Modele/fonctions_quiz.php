<?php

// Importation des ID et nom de tous les quizs
function importation_quiz()
{
    global $bdd;
    $req = $bdd->query('SELECT Quiz_Id, Quiz_Nom FROM quiz');
    $donnees = $req->fetchAll();

    return $donnees;
}

// Importation des questions et des réponses du quiz sélectionné
function importation_tout($id)
{
    global $bdd;
    $req = $bdd->prepare('SELECT * FROM quiz qz INNER JOIN questions qu ON qz.Quiz_Id = qu.Quiz_ID INNER JOIN reponses rep ON qu.Question_Id = rep.Question_Id WHERE qz.Quiz_Id = :id');
    $req->bindValue(':id', $id, PDO::PARAM_INT);
    $req->execute();
    $donnees = $req->fetchAll();

    return $donnees;
}

// Importation des questions et des bonnes réponses du quiz sélectionné
function importation_br($id)
{
    global $bdd;
    $req = $bdd->prepare('SELECT * FROM quiz qz INNER JOIN questions qu ON qz.Quiz_Id = qu.Quiz_ID INNER JOIN reponses rep ON qu.Question_Id = rep.Question_Id WHERE qz.Quiz_Id = :id AND rep.Reponse_State!=0');
    $req->bindValue(':id', $id, PDO::PARAM_INT);
    $req->execute();
    $donnees = $req->fetchAll();

    return $donnees;
}

// Importation de tous les quizs effectués par un utilisateur(id_session) et de ses résultats sur chaque quiz
function importation_quizs_util($session_id)
{
    global $bdd;
    $req = $bdd->prepare('SELECT * FROM historique WHERE Id_session = :id');
    $req->bindValue(':id', $session_id, PDO::PARAM_STR);
    $req->execute();
    $donnees = $req->fetchAll();

    return $donnees;
}

// Fonction qui permet de transformer Un tableau de plusieurs tableaux de données en architecture plus lisible (Tableaux d'objets questions qui contiennent des objets réponses)
function range_tableau($datas, $quiz)
{
    foreach ($datas as $data) 
    {
        $quiz_bis = new Quiz($data);
        if (isset($quiz[$quiz_bis->getId()])) 
        {
            // Permet de fusionner le nom de quiz et son id s'il éxiste déjà évitant ainsi la redondance lors de l'ajoùt d'une question
            $quiz[$quiz_bis->getId()]->fusion($quiz_bis);
        } else 
        {
            // Ajoute un nouveau nom de quiz et son id
            $quiz[$quiz_bis->getId()] = $quiz_bis;
        }
    }
    return $quiz;
}

// Fonction qui permet d'insérer en BDD un quiz fait par un utilisateur(en sérialisé), son résultat et son id de session
function range_hist_bdd($historique, $score, $session_id)
{
    global $bdd;
    $req = $bdd->prepare('INSERT INTO historique (Contenu_Util, Score_util, Id_session, Date_done) VALUES (:contenu, :score, :id_session, :date)');
    $date = new DateTime();
    $result = $date->format('Y-m-d H:i:s');
    $req->bindparam(':contenu', $historique, PDO::PARAM_STR);
    $req->bindparam(':score', $score, PDO::PARAM_STR);
    $req->bindparam(':id_session', $session_id, PDO::PARAM_STR);
    $req->bindparam(':date', $result, PDO::PARAM_STR);
    $req->execute();
}

// Fonction qui affiche le message juste ou faux suivant la variable $message et incrémente le score
function affichage_message($message, $score)
{
    if ($message == 1) 
    {
        echo "Vous avez eu juste !<br>";
        echo "Solutions :<br>";
        $score ++;
    }
    else
    {
        echo "Vous avez eu Faux !<br>";
        echo "Solutions :<br>";
    }
    return $score;
}

// Affiche les réponses (dont les bonnes en orange) des questions de type 1 - 2 - 3
function affichage_reponses($question)
{   
    foreach ($question->getReponses() as $rep) 
    {
        if ($rep->getState() == 1) 
        {
            echo '<p style=\'color: rgba(255,109,13);\'>' . $rep->getReponse() . '<p>';
        }
        else
        {
            echo '<p>' . $rep->getReponse() . '<p>';
        }
    }
}

// Affiche les réponses des questions de type 4
function affichage_reponses_4($question)
{
    foreach ($question->getReponses() as $rep) 
    {
        echo $rep->getState() . ' - ' . $rep->getReponse() . '<br>';
    }    
}

// Affiche les réponses de l'utilisateur
function hist_affichage_reps_util($quiz, $quizz, $question)
{
    echo "<p style=\"color: rgba(85,148,44);\">Votre(Vos) réponse(s) :<p>";
    echo '<em>' . implode('<br>', $quiz[$quizz->getId()][$question->getId()]) . '</em><br>';
    echo "<p style=\"color: rgba(85,148,44);\">Toutes les réponses :<p>";
}

// Affiche toutes les réponses (en gras les justes)
function hist_affichage_all_reps($question)
{
    foreach ($question->getReponses() as $rep)
    {
        if ($rep->getState() == 1) 
        {
            echo '<strong>' . $rep->getReponse() . '</strong><br>';
        }
        else
        {
            echo $rep->getReponse() . '<br>';
        }
    }
}

// Vérifie la présence des variable id_quiz et nom_quiz
function verif_presence_var()
{
    if (!isset($_GET['id_quiz']) OR !isset($_GET['nom_quiz'])) 
    {
        require_once 'Vue/404.php';
        die;
    }
}

// Fonction qui regarde si les variables $_GET['id_quiz'] et $_GET['nom_quiz'] éxistent et si elles correspondent à un quiz en BDD
function check_variables($id, $nom)
{
    global $bdd;
    $req = $bdd->prepare('SELECT Quiz_Id, Quiz_Nom FROM quiz WHERE Quiz_Id = :id_quiz AND Quiz_Nom = :nom_quiz');
    $req->bindparam('id_quiz', $id, PDO::PARAM_INT);
    $req->bindparam('nom_quiz', $nom, PDO::PARAM_STR);
    $req->execute();
    $resultat = $req->fetch();
    if (empty($resultat)) 
    {
        require_once 'Vue/404.php';
        die;
    }
}
