<?php

namespace App\Http\Controllers\Auth;

use DB;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Geocoder\Laravel\Facades\Geocoder as Geocoder;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'voornaam' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function addUser(Request $data)
    {
        try {
            $location = app('geocoder')->geocode($data['POSTCODE'], $data['STRAAT'], $data['HUISNUMMER'], $data['TOEVOEGING'], $data['PLAATS'])->all();
            $longitude = $location[0]->getLongitude();
            $latitude = $location[0]->getLatitude();
            DB::select('exec spInsertUser ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',array($data['GEBRUIKERSNAAM'],
            $data['VOORNAAM'], $data['TUSSENVOEGSEL'], $data['ACHTERNAAM'], $data['GEBOORTEDATUM'], $data['GESLACHT'], $data['MAILADRES'], bcrypt($data['WACHTWOORD']), $data['TELEFOON'], $data['POSTCODE'], $data['HUISNUMMER'], $data['TOEVOEGING'], $latitude, $longitude   ));
            return view('auth.login');
        }
        catch(\Illuminate\Database\QueryException $ex){
            print_r($ex->getMessage());
            session()->flash('message', 'Oeps, er is iets verkeerd gegaan! Probeer opnieuw');
            session()->flash('alert-class', 'alert-danger');
            return redirect()->back();
        }
    }
}
