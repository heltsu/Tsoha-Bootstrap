<?php

class Askare extends BaseModel {

    //Attribuutit
    public $id, $perheenjasen_id, $nimi, $tarkeys, $lisatty, $valmis;

    //Konstruktori
    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Askare');
        $query->execute();    
        $rows = $query->fetchAll();
        $askareet = array();  
        foreach ($rows as $row) {
            $askareet[] = new Askare(array(
                'id' => $row['id'],
                'perheenjasen_id'=> $row['perheenjasen_id'],
                'nimi' => $row['nimi'],
                'tarkeys' => $row['tarkeys'],
                'lisatty' => $row['lisatty'],
                'valmis' => $row['valmis']
                    )
            );
        }
        return $askareet;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT *FROM Askare WHERE id = :id LIMIT 1');
        $query->execute(array('id'=>$id));
        $row = $query->fetch();
      
            if ($row) {
                $askare = new Askare(array(
                    'id' => $row['id'],
                    'nimi' => $row['nimi'],
                    'tarkeys' => $row['tarkeys'],
                    'lisatty' => $row['lisatty'],
                    'valmis' => $row['valmis']
                ));
                return $askare;
            }
        return null;
    }
    
    public function save(){
        $query = DB::connection()->prepare
                ('INSERT INTO Askare (nimi, tarkeys, lisatty, valmis)VALUES(:nimi, :tarkeys, :lisatty, :valmis)RETURNING id');
        
        $query->execute(array(
            'nimi'=> $this->nimi,
            'tarkeys'=> $this->tarkeys,
            'lisatty'=>$this->lisatty,
            'valmis'=>$this->valmis
        ));
        $row = $query->fetch();
        $this->id = $row['id'];
    }

}

// = new Askare(array('id' => 1, 'nimi' => 'Tietokantojen harkkatyö', 'tärkeys' => '1'));

//  echo $harkkatyö->nimi;
    