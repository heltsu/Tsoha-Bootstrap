<?php

class Luokka extends BaseModel {

    public $id, $nimi;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_nimi');
    }
    
    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Luokka');
        $query->execute();
        $rows = $query->fetchAll();
        $luokat = array();
        foreach ($rows as $row) {
            $luokat[] = new Luokka(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                    ));
        }
        return $luokat;
    }
 
    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Luokka (nimi) VALUES (:nimi) RETURNING id');
        $query->execute(array(
            'nimi' => $this->nimi
                ));
        $row = $query->fetch();
        $this->id = $row['id'];
    }

    public function update($id) {
        $this->id = $id;  
        $query = DB::connection()->prepare('UPDATE Luokka SET nimi = :nimi WHERE id = :id');
        $query->execute(array(
            'nimi' => $this->nimi, 
            'id' => $this->id));
    }

    public static function find($id){
        $query = DB::connection()->prepare('SELECT * FROM Luokka WHERE id = :id');
        $query->execute(array(
            'id' => $id
                ));
        $row = $query->fetch();
        
        if($row){
            $luokka = new Luokka(array(
                'id' => $row['id'],
                'nimi' => $row['nimi']
            ));
            return $luokka;
        }
        return null;
    }
        
    public function destroy($id){
       $query = DB::connection()->prepare('DELETE FROM Askare WHERE id = :id');
       $query->execute(array(
           'id' => $id));
    
    }
    public function validate_nimi(){
        $errors = array();
        if ($this->nimi == '' || $this->nimi == null) {
            $errors[] = 'Luokka puuttuu!';
        }
        if (strlen($this->nimi) < 3) {
            $errors[] = 'Luokan nimen pituuden tulee olla vähintään kolme merkkiä!';
        }
        if (strlen($this->nimi) > 20){
            $errors[] = 'Luokan nimen pituuden on oltava alle 20 merkkiä!';
        }
        return $errors;
    }
}
