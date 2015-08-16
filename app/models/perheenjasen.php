<?php

class PerheenJasen extends BaseModel {

    public $id, $nimi, $salasana;

    public function _construct($attributes) {
        parent::__construct($attributes);
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Perheenjasen (nimi, salasana)VALUES(:nimi, :salasana) RETURNING id;');
        $query->execute(array(
            'nimi' => $this->nimi,
            'salasana' => $this->salasana
        ));
        $row = $query->fetch();
        $this->id = $row['id'];
    }

    public static function authenticate($nimi, $salasana) {
        $query = DB::connection()->prepare('SELECT * FROM Perheenjasen WHERE nimi = :nimi AND salasana = :salasana LIMIT 1', array('nimi' => $nimi, 'salasana' => $salasana));
        $query->execute(array(
            'nimi' => $nimi,
            'salasana' => $salasana
        ));
        $row = $query->fetch();
        if ($row) {
            $user = new PerheenJasen(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'salasana' => $row['salasana']
            ));
            return $user;
        } else {
            return null;
        }
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Perheenjasen WHERE id = :id LIMIT 1');
        $query->execute(array(
            'id' => $id
        ));
        $row = $query->fetch();
        if ($row) {
            $perheenjasen = new PerheenJasen(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'salasana' => $row['salasana']
            ));
            return $perheenjasen;
        }
        return null;
    }

    public function errors() {
        return null;
    }

}
