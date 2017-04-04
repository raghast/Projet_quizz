<?php

function importation_quiz()
{
    global $bdd;
    $req = $bdd->query('SELECT id_quiz, nom FROM nom_quiz');
    $donnees = $req->fetchAll();

    return $donnees;
}

function importation_questions($id)
{
    global $bdd;
    $req = $bdd->prepare('SELECT id_question, question, id_quiz FROM questions_quiz WHERE id_quiz = :id');
    $req->bindValue(':id', $id, PDO::PARAM_INT);
    $req->execute();
    $donnees = $req->fetchAll();

    return $donnees;
}

function importation_reponses($id)
{
    global $bdd;
    $req = $bdd->prepare('SELECT id_reponse, reponse, id_question FROM reponses_question WHERE id_question = :id');
    $req->bindValue(':id', $id, PDO::PARAM_INT);
    $req->execute();
    $donnees = $req->fetchAll();

    return $donnees;
}

function importation_br($id)
{
    global $bdd;
    $req = $bdd->prepare('SELECT id_br, bonne_reponse, id_question FROM bonne_reponse WHERE id_question = :id');
    $req->bindValue(':id', $id, PDO::PARAM_INT);
    $req->execute();
    $donnees = $req->fetchAll();

    return $donnees;
}
