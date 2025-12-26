<?php

class Transaction extends BaseModel {
    private $type;
    private $montant;
    private $date;
    private $compte_id;

    public function __construct($compte_id, $type, $montant) {
        $this->compte_id = $compte_id;
        $this->type = $type;
        $this->montant = $montant;
        $this->date = date("Y-m-d H:i:s");
    }

    public function save() {
    }
        
    public static function getHistorique($compte_id) {
        
    }
}
