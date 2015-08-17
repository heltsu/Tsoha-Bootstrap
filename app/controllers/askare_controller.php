<?php

class AskareController extends BaseController {

    public static function index() {
        self::check_logged_in();
        $askareet = Askare::all(BaseController::get_user_logged_in()->id);
        View::make('askare/index.html', array('askareet' => $askareet));
    }

    public static function show($id) {
        self::check_logged_in();
        $askare = Askare::find($id);
        Kint::dump($askare);
        View::make('askare/show.html', array('askare' => $askare));
    }

    public static function create() {
        self::check_logged_in();
        View::make('askare/new.html');
    }

    public static function store() {
        self::check_logged_in();
        $params = $_POST;
        
        $attributes = array(
            'nimi' => $params['nimi'],
            'tarkeys' => $params['tarkeys'],
            'valmis' => $params['valmis'],
            'muuta' => $params['muuta']
        );
        
        $askare = new Askare($attributes);
        $errors = $askare->errors();

        if (count($errors) == 0) {
            $askare->save();

            Redirect::to('/askare/' . $askare->id, array('message' => 'Askare lisätty'));
        } else {
            $testi = array('errors' => $errors, 'attributes' => $askare);
            Kint::dump($testi);
            View::make('askare/new.html', $testi );
        }
    }

    public static function edit($id) {
        self::check_logged_in();
        $askare = Askare::find($id);
        View::make('askare/edit.html', array('attributes' => $askare));
    }

    public static function update($id) {
        self::check_logged_in();
        $params = $_POST;
        $attributes = array(
            'nimi' => $params['nimi'],
            'tarkeys' => $params['tarkeys'],
            'valmis' => $params['valmis'],
            'muuta' => $params['muuta']
        );
        
        $askare = new Askare($attributes);
        $errors = $askare->errors();
        
        if (count($errors) > 0) {
            View::make('askare/edit.html', array('errors' => $errors, 'attributes' => $askare));
        } else {
            $askare->update($id);

            Redirect::to('askare/' . $askare->id, array('message' => 'Askareen muokkaus onnistui!'));
        }
    }

    public static function destroy($id) {
        self::check_logged_in();
        $askare = new Askare(array('id' => $id));
        $askare->destroy($id);

        Redirect::to('/askare/', array('message' => 'Askare poistettu onnistuneesti!'));
    }

}
