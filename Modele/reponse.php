<?php

class Reponse
{
  private $id;
  private $reponse;
  private $state;

    public function __construct($data)
    {
        $this->hydrate($data);
    }

    // Liste des getters

    public function getId() 
    {
        return $this->id;
    }

    public function getReponse() 
    {
        return $this->reponse;
    }

    public function getState() 
    {
        return $this->state;
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
          $this->id = $id;
        }
    }

    public function setReponse($reponse)
    {
        // On vérifie qu'il s'agit bien d'une chaîne de caractères.
        if (is_string($reponse))
        {
          $this->reponse = $reponse;
        }
    }

    public function setState($state)
    {
        // On convertit l'argument en nombre entier.
        // Si c'en était déjà un, rien ne changera.
        // Sinon, la conversion donnera le nombre 0 (à quelques exceptions près, mais rien d'important ici).
        $state = (int) $state;
    
        // On vérifie ensuite si ce nombre est bien strictement positif.
        if ($state > 0)
        {
          // Si c'est le cas, c'est tout bon, on assigne la valeur à l'attribut correspondant.
          $this->state = $state;
        }
    }

    public function hydrate($data)
    {
      // Affectation des valeurs de la réponses aux attributs respectifs
      $this->setId($data['Reponse_Id']);
      $this->setReponse($data['Reponse_Reponse']);
      $this->setState($data['Reponse_State']);
    }
}
