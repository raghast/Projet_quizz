<?php

class Reponse
{
  private $_id;
  private $_reponse;
  private $_id_question;
  
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
  
  public function reponse()
  {
    return $this->_reponse;
  }

  // Liste des setters
  
  public function setId($id)
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
  
  public function setReponse($reponse)
  {
    // On vérifie qu'il s'agit bien d'une chaîne de caractères.
    if (is_string($reponse))
    {
      $this->_reponse = $reponse;
    }
  }

  public function setIdQuestion($id_question)
  {
     // On convertit l'argument en nombre entier.
    // Si c'en était déjà un, rien ne changera.
    // Sinon, la conversion donnera le nombre 0 (à quelques exceptions près, mais rien d'important ici).
    $id_question = (int) $id_question;
    
    // On vérifie ensuite si ce nombre est bien strictement positif.
    if ($id_question > 0)
    {
      // Si c'est le cas, c'est tout bon, on assigne la valeur à l'attribut correspondant.
      $this->_id_question = $id_question;
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