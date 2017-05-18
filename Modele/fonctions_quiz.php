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
