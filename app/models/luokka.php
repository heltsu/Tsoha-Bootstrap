<?php

class Luokka extends BaseModel {

    public $id, $nimi;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function save($nimi) {
        $query = DB::connection()->prepare('INSERT INTO Luokka (nimi) VALUES (:nimi) RETURNING id');
        $query->execute(array('nimi' => $nimi));
        $row = $query->fetch();
        return $row['id'];
    }

    public function update() {
        $query = DB::connection()->prepare('UPDATE Luokka SET nimi = :nimi WHERE id = :id');
        $query->execute(array('nimi' => $this->nimi, 'id' => $this->id));
    }

    public static function findByName($nimi) {
        $query = DB::connection()->prepare('SELECT * FROM Luokka WHERE nimi = :nimi');
        $query->execute(array('nimi' => $nimi));
        $row = $query->fetch();
        if ($row) {
            $luokka = new Luokka(array(
                'nimi' => $row['nimi'],
                'id' => $row['id']
            ));
            return $luokka;
        }
        return null;
    }
    
    public static function findOne($id){
        $query = DB::connection()->prepare('SELECT * FROM Luokka WHERE id = :id');
        $query->execute(array('id' => $id));
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
    
    public function delete($id){
        $query = DB::connection()->prepare('DELETE FROM Luokka WHERE id = :id');
        $query->execute(array('id' => $id));
    }
    
    public function errors(){
        return null;
    }
}
