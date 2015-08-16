<?php

class LuokanAskareet extends BaseModel {

    public $askare_id, $luokka_id;

    public function _construct($attributes) {
        parent::_construct($attributes);
    }

    public static function delete($askare_id) {
        $query = DB::connection()->prepare('DELETE FROM LuokanAskareet WHERE askare_id = :askare_id');
        $query->execute(array(
            'askare_id' => $askare_id
        ));
    }

    public static function save($askare_id, $luokka_id) {
        $query = DB::connection()->prepare('INSERT INTO LuokanAskareet VALUES (:luokka_id, :askare_id)');
        $query->execute(array(
            'askare_id' => $askare_id,
            'luokka_id' => $luokka_id
        ));
    }

    public static function findOne($luokka_id, $askare_id) {
        $query = DB::connection()->prepare('SELECT * FROM LuokanAskareet WHERE askare_id = :askare_id AND luokka_id = :luokka_id');
        $query->execute(array(
            'askare_id' => $askare_id,
            'luokka_id' => $luokka_id
        ));
        $row = $query->fetch();
        if ($row) {
            $luokanaskare = new LuokanAskareet(array(
                'luokka_id' => $row['luokka_id'],
                'askare_id' => $row['askare_id']
            ));
            return $luokanaskare;
        }
        return null;
    }
}
