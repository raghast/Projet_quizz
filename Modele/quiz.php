<?php

class Quiz
{
  private $id;
  private $nom;
  private $questions;
  
  public function __construct($data)
  {
      $this->questions = [];
      $this->hydrate($value);
  }

  // Liste des getters
  
  public function getId()
  {
    return $this->id;
  }
  
  public function getNom()
  {
    return $this->nom;
  }
  
  public function getQuestions()
  {
    return $this->questions;
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
  
  public function setNom($nom)
  {
    // On vérifie qu'il s'agit bien d'une chaîne de caractères.
    if (is_string($nom))
    {
      $this->nom = $nom;
    }
  }
  
  public function hydrate($data)
  {
     $this->setId($data['Quiz_Id']);
     $this->setNom($data['Quiz_Nom']);
     if (isset($data['Question_Question'])) 
     {
       $question = new Question($data);
       if (!empty($this->questions[$question->getId()])) 
       {
         $this->questions[$question->getId()]->fusion($question);
       } else 
       {
         $this->questions[$question->getId()] = $question;
       }
      }
  }

  public function fusion(Quiz $quiz)
  {
     $this->questions = array_replace($this->questions, $quiz->getQuestions());
  }
}
