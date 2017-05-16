<?php

namespace App\Http\Controllers\Auth;

use DB;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = '/';

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
            'mailadres' => 'required|string|email|max:255|unique:gebruiker',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function addUser(array $data)
    {
        //  DB::select('exec spInsertUser ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?',array($data['gebruikersnaam'],
        //  $data['voornaam'], $data['tussenvoegsel'], $data['achternaam'], $data['geboortedatum'], $data['geslacht'], $data['mailadres'], bcrypt($data['password']), $data['telefoon'], $data['postcode'], $data['huisnummer'], $data['toevoeging']));

        //DB::select('exec spTest ?', array($data['voornaam']));
        return User::create([
            'gebruikersnaam' => $data['gebruikersnaam'],
            'voornaam' => $data['voornaam'],
            'tussenvoegsel' => $data['tussenvoegsel'],
            'achternaam' => $data['achternaam'],
            'geboortedatum' => $data['geboortedatum'],
            'geslacht' => $data['geslacht'],
            'email' => $data['email'],
            'bedrijfsID' => $data['bedrijfsID'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
