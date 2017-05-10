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

                        <div class="form-group{{ $errors->has('voornaam') ? ' has-error' : '' }}">
                            <label for="voornaam" class="col-md-4 control-label">Voornaam</label>

                            <div class="col-md-6">
                                <input id="voornaam" type="text" class="form-control" name="voornaam" value="{{ old('voornaam') }}" required autofocus>

                                @if ($errors->has('voornaam'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('voornaam') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('tussenvoegsel') ? ' has-error' : '' }}">
                            <label for="tussenvoegsel" class="col-md-4 control-label">tussenvoegsel</label>

                            <div class="col-md-6">
                                <input id="tussenvoegsel" type="text" class="form-control" name="tussenvoegsel" value="{{ old('tussenvoegsel') }}" autofocus>

                                @if ($errors->has('voornaam'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tussenvoegsel') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('achternaam') ? ' has-error' : '' }}">
                            <label for="achternaam" class="col-md-4 control-label">achternaam</label>

                            <div class="col-md-6">
                                <input id="achternaam" type="text" class="form-control" name="achternaam" value="{{ old('achternaam') }}" required autofocus>

                                @if ($errors->has('achternaam'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('achternaam') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('achternaam') ? ' has-error' : '' }}">
                            <label for="geboortedatum" class="col-md-4 control-label">geboortedatum</label>

                            <div class="col-md-6">
                                <input id="geboortedatum" type="date" class="form-control" name="geboortedatum" value="{{ old('geboortedatum') }}" required>

                                @if ($errors->has('geboortedatum'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('geboortedatum') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('geslacht') ? ' has-error' : '' }}">
                            <label for="geslacht" class="col-md-4 control-label">geslacht</label>

                            <div class="col-md-6">
                                <input id="geslacht" type="text" class="form-control" name="geslacht" value="{{ old('geslacht') }}" required>

                                @if ($errors->has('geslacht'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('geslacht') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('bedrijfsID') ? ' has-error' : '' }}">
                            <label for="bedrijfsID" class="col-md-4 control-label">bedrijfsID</label>

                            <div class="col-md-6">
                                <input id="bedrijfsID" type="text" class="form-control" name="bedrijfsID">

                                @if ($errors->has('bedrijfsID'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('bedrijfsID') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
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



                        <div class="form-group{{ $errors->has('postcode') ? ' has-error' : '' }}">
                            <label for="postcode" class="col-md-4 control-label">Postcode</label>

                            <div class="col-md-6">
                                <input id="postcode" type="text" class="form-control" name="postcode" required>

                                @if ($errors->has('postcode'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('postcode') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('huisnummer') ? ' has-error' : '' }}">
                            <label for="huisnummer" class="col-md-4 control-label">Huisnummer</label>

                            <div class="col-md-6">
                                <input id="huisnummer" type="text" class="form-control" name="huisnummer" required>

                                @if ($errors->has('huisnummer'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('huisnummer') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('toevoeging') ? ' has-error' : '' }}">
                            <label for="toevoeging" class="col-md-4 control-label">Toevoeging</label>

                            <div class="col-md-6">
                                <input id="toevoeging" type="text" class="form-control" name="toevoeging">

                                @if ($errors->has('toevoeging'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('toevoeging') }}</strong>
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
