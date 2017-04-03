<?php

class QuestionManager
{
  private $_db; // Instance de PDO.

  public function __construct($db)
  {
    $this->setDb($db);
  }

  public function get($id)
  {
    // Exécute une requête de type SELECT avec une clause WHERE, et retourne un objet Personnage.
    $q = $this->_db->prepare('SELECT id_question, question, id_quiz FROM questions_quiz WHERE id_quiz = :id');
    $q->bindValue(':id', $id, PDO::PARAM_INT);
    $q->execute();
    $donnees = $q->fetch(PDO::FETCH_ASSOC);

    return new Question($donnees);
  }
  
  public function setDb(PDO $db)
  {
    $this->_db = $db;
  }
}