@extends('layout.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('GEBRUIKERSNAAM') ? ' has-error' : '' }}">
                            <label for="GEBRUIKERSNAAM" class="col-md-4 control-label">Gebruikersnaam</label>

                            <div class="col-md-6">
                                <input id="GEBRUIKERSNAAM" type="text" class="form-control" name="GEBRUIKERSNAAM" value="{{ old('GEBRUIKERSNAAM') }}" required autofocus>

                                @if ($errors->has('GEBRUIKERSNAAM'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('GEBRUIKERSNAAM') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('VOORNAAM') ? ' has-error' : '' }}">
                            <label for="VOORNAAM" class="col-md-4 control-label">Voornaam</label>

                            <div class="col-md-6">
                                <input id="VOORNAAM" type="text" class="form-control" name="VOORNAAM" value="{{ old('VOORNAAM') }}" required >

                                @if ($errors->has('VOORNAAM'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('VOORNAAM') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('TUSSENVOEGSEL') ? ' has-error' : '' }}">
                            <label for="TUSSENVOEGSEL" class="col-md-4 control-label">Tussenvoegsel</label>

                            <div class="col-md-6">
                                <input id="TUSSENVOEGSEL" type="text" class="form-control" name="TUSSENVOEGSEL" value="{{ old('TUSSENVOEGSEL') }}" >

                                @if ($errors->has('TUSSENVOEGSEL'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('TUSSENVOEGSEL') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('ACHTERNAAM') ? ' has-error' : '' }}">
                            <label for="ACHTERNAAM" class="col-md-4 control-label">Achternaam</label>

                            <div class="col-md-6">
                                <input id="ACHTERNAAM" type="text" class="form-control" name="ACHTERNAAM" value="{{ old('ACHTERNAAM') }}" required >

                                @if ($errors->has('ACHTERNAAM'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ACHTERNAAM') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('GEBOORTEDATUM') ? ' has-error' : '' }}">
                            <label for="GEBOORTEDATUM" class="col-md-4 control-label">Geboortedatum</label>

                            <div class="col-md-6">
                                <input id="GEBOORTEDATUM" type="date" class="form-control" name="GEBOORTEDATUM" value="{{ old('GEBOORTEDATUM') }}" required >

                                @if ($errors->has('GEBOORTEDATUM'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('GEBOORTEDATUM') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('GESLACHT') ? ' has-error' : '' }}">
                            <label for="GESLACHT" class="col-md-4 control-label">Geslacht</label>

                            <div class="col-md-6">
                                <select id="GESLACHT" type="text" class="form-control" name="GESLACHT" required>
                                    <option value="M">Man</option>
                                    <option value="V">Vrouw</option>
                                    <option value="O">Onzijdig</option>
                                </select>
                                @if ($errors->has('GESLACHT'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('GESLACHT') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('MAILADRES') ? ' has-error' : '' }}">
                            <label for="MAILADRES" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="MAILADRES" type="email" class="form-control" name="MAILADRES" value="{{ old('MAILADRES') }}" required>

                                @if ($errors->has('MAILADRES'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('MAILADRES') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('WACHTWOORD') ? ' has-error' : '' }}">
                            <label for="WACHTWOORD" class="col-md-4 control-label">Wachtwoord</label>

                            <div class="col-md-6">
                                <input id="WACHTWOORD" type="password" class="form-control" name="WACHTWOORD" required>

                                @if ($errors->has('WACHTWOORD'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('WACHTWOORD') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('TELEFOON') ? ' has-error' : '' }}">
                            <label for="TELEFOON" class="col-md-4 control-label">Telefoon</label>

                            <div class="col-md-6">
                                <input id="TELEFOON" type="tel" class="form-control" name="TELEFOON" value="{{ old('TELEFOON') }}" required>

                                @if ($errors->has('TELEFOON'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('TELEFOON') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('STRAAT') ? ' has-error' : '' }}">
                            <label for="STRAAT" class="col-md-4 control-label">Straat</label>

                            <div class="col-md-6">
                                <input id="STRAAT" type="text" class="form-control" name="STRAAT" value="{{ old('STRAAT') }}" required>

                                @if ($errors->has('STRAAT'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('STRAAT') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('HUISNUMMER') ? ' has-error' : '' }}">
                            <label for="HUISNUMMER" class="col-md-4 control-label">Huisnummer</label>

                            <div class="col-md-6">
                                <input id="HUISNUMMER" type="number" class="form-control" name="HUISNUMMER" value="{{ old('HUISNUMMER') }}" required>

                                @if ($errors->has('HUISNUMMER'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('HUISNUMMER') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('TOEVOEGING') ? ' has-error' : '' }}">
                            <label for="TOEVOEGING" class="col-md-4 control-label">Toevoeging</label>

                            <div class="col-md-6">
                                <input id="TOEVOEGING" type="text" class="form-control" name="TOEVOEGING" value="{{ old('TOEVOEGING') }}" >

                                @if ($errors->has('TOEVOEGING'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('TOEVOEGING') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('POSTCODE') ? ' has-error' : '' }}">
                            <label for="POSTCODE" class="col-md-4 control-label">Postcode</label>

                            <div class="col-md-6">
                                <input id="POSTCODE" type="text" class="form-control" name="POSTCODE" value="{{ old('POSTCODE') }}" required>

                                @if ($errors->has('POSTCODE'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('POSTCODE') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('PLAATS') ? ' has-error' : '' }}">
                            <label for="PLAATS" class="col-md-4 control-label">Plaats</label>

                            <div class="col-md-6">
                                <input id="PLAATS" type="text" class="form-control" name="PLAATS" value="{{ old('PLAATS') }}" required>

                                @if ($errors->has('PLAATS'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('PLAATS') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
