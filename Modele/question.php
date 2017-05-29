<?php

class Question
{
    private $id;
    private $type;
    private $question;
    private $reponses;

    public function __construct($data)
    {
        $this->reponses = [];
        $this->hydrate($data);
    }

    // Liste des getters
  
    public function getId()
    {
        return $this->id;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getQuestion()
    {
        return $this->question;
    }
    
    public function getReponses()
    {
        return $this->reponses;
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

    public function setType($type)
    {
        // On convertit l'argument en nombre entier.
        // Si c'en était déjà un, rien ne changera.
        // Sinon, la conversion donnera le nombre 0 (à quelques exceptions près, mais rien d'important ici).
        $type = (int) $type;
    
        // On vérifie ensuite si ce nombre est bien strictement positif.
        if ($type > 0)
        {
          // Si c'est le cas, c'est tout bon, on assigne la valeur à l'attribut correspondant.
          $this->type = $type;
        }
    }
  
    public function setQuestion($question)
    {
        // On vérifie qu'il s'agit bien d'une chaîne de caractères.
        if (is_string($question))
        {
          $this->question = $question;
        }
    }

    public function hydrate($data) 
    {
        // Affectation de l'id, du type et de l'intitulé de la question aux attributs respectifs
        $this->setId($data['Question_Id']);
        $this->setType($data['Question_Type']);
        $this->setQuestion($data['Question_Question']);
        // Création d'un objet réponse et affectation de cet objet dans l'attribut tableau $reponses
        $reponse = new Reponse($data);
        $this->reponses[$reponse->getId()] = $reponse;
    }

    public function fusion(Question $question)
    {
        // Fusionne les questions identiques possédant des réponses différentes (Pour n'avoir qu'une question contenant ses réponses)
        $this->reponses = array_replace($this->reponses, $question->getReponses());
    }
}
