<?php

class ReponseManager
{
  private $_db; // Instance de PDO.

  public function __construct($db)
  {
    $this->setDb($db);
  }

  public function get($id)
  {
    // Exécute une requête de type SELECT avec une clause WHERE, et retourne un objet Personnage.
    $q = $this->_db->prepare('SELECT id_reponse, reponse, id_question FROM reponses_question WHERE id_question = :id');
    $q->bindValue(':id', $id, PDO::PARAM_INT);
    $q->execute();
    $donnees = $q->fetch(PDO::FETCH_ASSOC);

    return new Reponse($donnees);
  }
  
  public function setDb(PDO $db)
  {
    $this->_db = $db;
  }
}