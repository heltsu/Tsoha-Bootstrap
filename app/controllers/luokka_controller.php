<?php

class LuokkaController extends BaseController {

    public static function index() {
        self::check_logged_in();
        $luokat = Luokka::all();
        View::make('luokka/index.html', array('luokat' => $luokat));
    }

    public static function show($id) {
        self::check_logged_in();
        $luokka = Luokka::find($id);
 //       Kint::dump($luokka);
        View::make('luokka/show.html', array('luokka' => $luokka));
    }

    public static function create() {
        self::check_logged_in();
        View::make('luokka/new.html');
    }

    public static function store() {
        self::check_logged_in();
        $user_logged_in = self::get_user_logged_in();

        $params = $_POST;
        $attributes = array(
            'nimi' => $params['nimi'],
            'perheenjasen_id' => $user_logged_in->id
        );

        $luokka = new Luokka($attributes);
        $errors = $luokka->errors();

        if (count($errors) == 0) {
            $luokka->save();

            Redirect::to('/luokka/' . $luokka->id, array('message' => 'Luokka on lisätty listallesi!'));
        } else {
            View::make('luokka/new.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }

    public static function edit($id) {
        $luokka = Luokka::find($id);
            View::make('luokka/edit.html', array('attributes' => $luokka));
    }

    public static function update($id) {
        $params = $_POST;

        $attributes = array(
            'id' => $id,
            'nimi' => $params['nimi'],
        );
        $luokka = new Luokka($attributes);
        $errors = $luokka->errors();

        if (count($errors) == 0) {
            $luokka->update($id);

            Redirect::to('/luokka/' . $luokka->id, array('message' => 'Luokkaa muokattu onnistuneesti!'));
        } else {
            View::make('/luokka/edit.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }

    public static function destroy($id) {
        self::check_logged_in();
        $luokka = new Luokka(array('id' => $id));
        $luokka ->destroy($id);;

        Redirect::to('/luokka', array('message' => 'Luokka on poistettu listalta!'));
    }

}
