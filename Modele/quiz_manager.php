<?php

class QuizManager
{
  private $_db; // Instance de PDO.

  public function __construct($db)
  {
    $this->setDb($db);
  }

  public function getList()
  {
    $quiz = [];
    $q = $this->_db->query('SELECT id_quiz, nom FROM nom_quiz ORDER BY nom');
    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
      $quiz[] = new Quiz($donnees);
    }
    return $quiz;
  } 

  public function get($id)
  {
    // Exécute une requête de type SELECT avec une clause WHERE, et retourne un objet Personnage.
    $q = $this->_db->prepare('SELECT id_quiz, nom FROM nom_quiz WHERE id_quiz = :id');
    $q->bindValue(':id', $id, PDO::PARAM_INT);
    $q->execute();
    $donnees = $q->fetch(PDO::FETCH_ASSOC);

    return new Quiz($donnees);
  }
  
  public function setDb(PDO $db)
  {
    $this->_db = $db;
  }
}