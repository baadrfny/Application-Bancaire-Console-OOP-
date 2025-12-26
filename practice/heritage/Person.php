<?php

class Person {
    private $nom;
    private $prenom;
    private $age;

    public function __construct($nom , $prenom , $age)
    {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->age = $age;
    }
    
}

?>