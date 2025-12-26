<?php 

require_once "../OOP/practice/heritage/Person.php"; 

class Etudiant extends Person{
    protected $note;


    public function __construct($nom, $prenom , $age, $note)
    {
        parent:: __construct($nom, $prenom, $age);
        $this->note = $note;
    }
}

?>