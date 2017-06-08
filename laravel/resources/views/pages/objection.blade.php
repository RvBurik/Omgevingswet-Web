@extends('layout.app')
@section('title', '- Project')
@section('class', 'portfolio-page')

@section('content')
<div class="row">
    <div class="col-lg-12">
        @if (Auth::user() == null)
            <h3>U moet ingelogd zijn om projecten te kunnen bekijken.</h3>
            <p>Klik <a href="/login">hier</a> om in te loggen.</p>
        @elseif (!empty($project) && $project->isVisibleToUser(Auth::user()))
            <div class="panel panel-default col-lg-12">
                <div class="panel-heading">
                    <h2>Projectinformatie</h2>
                </div>
                <div class="panel-body"
                    <h3>{{ $project->PROJECTTITEL }}</h3>
                    <p>{{ $project->WERKZAAMHEID }}</p>
                        <p>
                            <b>Contactpersoon: </b>{{$particulier->fullName()}}
                    </p>
                    <p>Project aangemaakt op {{$project->AANGEMAAKTOP}}.</p>
                </div>

            <div class="panel panel-default col-lg-12">
                <div class="panel-heading">
                    <h2>Bezwaar aantekenen</h2>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('objection') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('reason') ? ' has-error' : '' }}">
                            <label for="reason" class="col-md-12 ">Reden</label>
                            <div class="col-md-6">

                                <textarea rows="4" cols="100" id="reason" class="text" class="form-control" name="reason" value="{{ old('reason') }}" required></textarea>

                                <input id="PROJECTID" type="hidden" name="PROJECTID" value="{{$project->PROJECTID}}">
                                @if($vergunning != NULL)
                                    <input id="VERGUNNINGSID" type="hidden" name="VERGUNNINGSID" value="{{$vergunning->VERGUNNINGSID}}">
                                @endif
                                @if ($errors->has('reason'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('reason') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 ">
                                <button type="submit" class="btn btn-primary">
                                    Verstuur
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>

            @if (count($project->permits) > 0)
                <div class="panel panel-default col-lg-12">
                    <div class="panel-heading">
                        <h2>Vergunningen</h2>
                    </div>
                    <div class="panel-body">
                        @foreach ($project->permits as $permit)
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3>{{$permit->VERGUNNINGSNAAM}}</h3>
                                </div>
                                <div class="panel-body">
                                    <p>{{$permit->OMSCHRIJVING}}</p>
                                    <p><b>Status: </b>{{$permit->STATUS}}</p>
                                    <p><i>
                                        Aangevraagd op: {{$permit->DATUMAANVRAAG}}
                                        @if (!empty($permit->DATUMUITGAVE))
                                            <br>Uitgegeven op: {{$permit->DATUMUITGAVE}}
                                        @endif
                                        @if (!empty($permit->DATUMVERLOOP))
                                            <br>Verloopt op: {{$permit->DATUMVERLOOP}}
                                        @endif
                                    </i></p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @else
            <h3>Dit project bestaat niet of u heeft mogelijk geen toestemming om dit project te bekijken.</h3>
            <p>Klik <a href="/project">hier</a> om uw projecten te bekijken.</p>
        @endif
    </div>
</div>
@endsection
