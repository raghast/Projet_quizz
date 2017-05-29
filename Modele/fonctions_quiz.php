<?php

function importation_quiz()
{
    global $bdd;
    $req = $bdd->query('SELECT Quiz_Id, Quiz_Nom FROM quiz');
    $donnees = $req->fetchAll();

    return $donnees;
}

function importation_tout($id)
{
    global $bdd;
    $req = $bdd->prepare('SELECT * FROM quiz qz INNER JOIN questions qu ON qz.Quiz_Id = qu.Quiz_ID INNER JOIN reponses rep ON qu.Question_Id = rep.Question_Id WHERE qz.Quiz_Id = :id');
    $req->bindValue(':id', $id, PDO::PARAM_INT);
    $req->execute();
    $donnees = $req->fetchAll();

    return $donnees;
}

function importation_br($id)
{
    global $bdd;
    $req = $bdd->prepare('SELECT * FROM quiz qz INNER JOIN questions qu ON qz.Quiz_Id = qu.Quiz_ID INNER JOIN reponses rep ON qu.Question_Id = rep.Question_Id WHERE qz.Quiz_Id = :id AND rep.Reponse_State=1');
    $req->bindValue(':id', $id, PDO::PARAM_INT);
    $req->execute();
    $donnees = $req->fetchAll();

    return $donnees;
}

function is_autorized($Quiz_Id)
{
    if (isset($_SESSION['Quiz_done'][$Quiz_Id])) 
    {
        $message = 'Vous avez déjà effectué ce quiz !';
        addFlash($message);
        header('Location: ?controller=accueil_quiz');
        die;
    }
}

function check_id($id)
{
        global $bdd;
        $req = $bdd->prepare('SELECT Quiz_Id FROM quiz WHERE Quiz_Id = :id_quiz');
        $req->bindparam('id_quiz', $id, PDO::PARAM_INT);
        $req->execute();
        $resultat = $req->fetch();
        if (empty($resultat)) 
        {
            require_once 'Vue/404.php';
            die;
        }       
}

function remplissage($reponse, $id_quiz)
{
    if (empty($reponse)) 
    {
            $message = 'Veuillez remplir tout le quiz';
            addFlash($message);
            header('Location: ?controller=page_quiz&&id_quiz='.$id_quiz);
            die;
    }
}

function check_variable()
{
    if (!isset($_GET['id_quiz'])) 
    {
        require_once 'Vue/404.php';
        die;
    }
}
