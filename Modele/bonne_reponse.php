<?php

class BReponse
{
  private $_id;
  private $_bonne_reponse;
  private $_question;
  private $_id_question_br;
  
  public function __construct($value = array())
  {
      if(!empty($value))
      $this->hydrate($value);
  }

  // Liste des getters
  
  public function id()
  {
    return $this->_id;
  }
  
  public function brep()
  {
    return $this->_bonne_reponse;
  }

  public function question()
  {
    return $this->_question;
  }

  // Liste des setters
  
  public function setId_Br($id)
  {
    // On convertit l'argument en nombre entier.
    // Si c'en était déjà un, rien ne changera.
    // Sinon, la conversion donnera le nombre 0 (à quelques exceptions près, mais rien d'important ici).
    $id = (int) $id;
    
    // On vérifie ensuite si ce nombre est bien strictement positif.
    if ($id > 0)
    {
      // Si c'est le cas, c'est tout bon, on assigne la valeur à l'attribut correspondant.
      $this->_id = $id;
    }
  }
  
  public function setQuestion($question)
  {
    // On vérifie qu'il s'agit bien d'une chaîne de caractères.
    if (is_string($question))
    {
      $this->_question = $question;
    }
  }

  public function setBonne_Reponse($brep)
  {
    // On vérifie qu'il s'agit bien d'une chaîne de caractères.
    if (is_string($brep))
    {
      $this->_bonne_reponse = $brep;
    }
  }

  public function setId_Question_Br($id_question_br)
  {
     // On convertit l'argument en nombre entier.
    // Si c'en était déjà un, rien ne changera.
    // Sinon, la conversion donnera le nombre 0 (à quelques exceptions près, mais rien d'important ici).
    $id_question_br = (int) $id_question_br;
    
    // On vérifie ensuite si ce nombre est bien strictement positif.
    if ($id_question_br > 0)
    {
      // Si c'est le cas, c'est tout bon, on assigne la valeur à l'attribut correspondant.
      $this->_id_question_br = $id_question_br;
    }
  }

  public function hydrate(array $donnees)
  {
  foreach ($donnees as $key => $value)
  {
    // On récupère le nom du setter correspondant à l'attribut.
    $method = 'set'.ucfirst($key);
        
    // Si le setter correspondant existe.
    if (method_exists($this, $method))
    {
      // On appelle le setter.
      $this->$method($value);
    }
  }
  }
}
