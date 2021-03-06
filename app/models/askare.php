<?php

class Askare extends BaseModel {

    //Attribuutit
    public $id, $perheenjasen_id, $nimi, $tarkeys, $lisatty, $valmis, $muuta;

    //Konstruktori
    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array(
            'validate_nimi', 
            'validate_tarkeys',
            'validate_valmis',
            'validate_muuta');
    }

    public static function all($id) {
        $query = DB::connection()->prepare('SELECT * FROM Askare WHERE perheenjasen_id = :id');
        $query->execute(array('id' => $id));
        $rows = $query->fetchAll();
        $askareet = array();
        foreach ($rows as $row) {
            $askareet[] = new Askare(array(
                'id' => $row['id'],
                'perheenjasen_id' => $row['perheenjasen_id'],
                'nimi' => $row['nimi'],
                'tarkeys' => $row['tarkeys'],
                'lisatty' => $row['lisatty'],
                'valmis' => $row['valmis'],
                'muuta' => $row['muuta']
                    ));
        }
        return $askareet;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Askare WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $askare = new Askare(array(
                'id' => $row['id'],
                'perheenjasen_id' => $row['perheenjasen_id'],
                'nimi' => $row['nimi'],
                'tarkeys' => $row['tarkeys'],
                'lisatty' => $row['lisatty'],
                'valmis' => $row['valmis'],
                'muuta'  => $row['muuta']
            ));
            $askare->valmis = date('d.m.Y', strtotime($askare->valmis)); 
    //        Kint::dump($askare);
            return $askare;
        }
        return null;
    }

    public function save() {
        $query = DB::connection()->prepare
                ('INSERT INTO Askare (perheenjasen_id, nimi, tarkeys, lisatty, valmis, muuta)VALUES(:perheenjasen_id, :nimi, :tarkeys, NOW(), :valmis, :muuta)RETURNING id');

        $query->execute(array(
            'perheenjasen_id' => BaseController::get_user_logged_in()->id,
            'nimi' => $this->nimi,
            'tarkeys' => $this->tarkeys,
            'valmis' => $this->valmis,
            'muuta' => $this->muuta
        ));
        $row = $query->fetch();
        Kint::dump($row);
        $this->id = $row['id'];
    }
    
    public function destroy($id){
       $query = DB::connection()->prepare('DELETE FROM Askare WHERE id = :id');
       $query->execute(array(
           'id' => $id));
    }
        
    public function update($id){
        $this->id = $id;  
        $query = DB::connection()->prepare('UPDATE Askare SET 
                nimi = :nimi, 
                tarkeys = :tarkeys, 
                valmis = :valmis, 
                muuta = :muuta
                WHERE id = :id');
        
        $query->execute(array(
            'id' => $this->id,
            'nimi' => $this->nimi, 
            'tarkeys' => $this->tarkeys, 
            'valmis' => $this->valmis, 
            'muuta' => $this->muuta));
        
    }

    public function validate_nimi(){
        $errors = array();
        if ($this->nimi == '' || $this->nimi == null) {
            $errors[] = 'Askare puuttuu!';
        }
        if (strlen($this->nimi) < 3) {
            $errors[] = 'Askareen nimen pituuden tulee olla vähintään kolme merkkiä!';
        }
        if (strlen($this->nimi) > 20){
            $errors[] = 'Askareen nimen pituuden on oltava alle 20 merkkiä!';
        }
        return $errors;
    }
    
    public function validate_tarkeys(){
        $errors = array();
        if($this->tarkeys == '' || $this->tarkeys == null){
            $errors[] = 'Askareen tärkeyden tulee olla numero välillä 1-5!';
        }
        if(!is_numeric($this->tarkeys)){
            $errors[]='Askareen tärkeyden tulee olla numero!';
        }
        if(is_numeric($this->tarkeys)&&($this->tarkeys < 1 || $this->tarkeys > 5)){
            $errors[]='Askareen tärkeyden tulee olla välillä 1-5!';
        }
        return $errors;
    }
    
    public function validate_muuta() {
        $errors = array();
        if ($this->muuta == '' || $this->muuta == null) {
            $errors[] = 'Askareen lisätieto ei saa olla tyhjä!';
        }
        if(strlen($this->muuta)>1000){
            $errors[] = 'Askareen lisätieto ei saa olla yli tuhat merkkiä!';
        }
        return $errors;
    }

    public function validate_valmis() {
        $errors = array();
        if ($this->valmis == '' || $this->valmis == null){
            $errors[] = 'Päivämäärä ei saa olla tyhjä!';
        }
        if (date('d.m.Y', strtotime($this->valmis)) != $this->valmis){
            $errors[] = 'Virheellinen päivämäärä! (pp.kk.vvvv)';
        }
        return $errors;
    }
}
