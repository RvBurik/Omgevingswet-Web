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
            <div class="panel panel-default col-lg-6">
                <div class="panel-heading">
                    <h2>Projectinformatie</h2>
                </div>
                <div class="panel-body">
                    <h3>Projecttitel</h3>
                    <p>{{$project->WERKZAAMHEID}}</p>
                        <p>
                        @if ($project->KVKNUMMER == null)
                            <b>Projecteigenaar: </b>{{$project->user->fullName()}} ({{$project->user->GEBRUIKERSNAAM}})
                        @else
                            <b>Projecteigenaar: </b>{{$project->company->BEDRIJFSNAAM}}<br>
                            <b>Contactpersoon: </b>{{$project->user->fullName()}} ({{$project->user->GEBRUIKERSNAAM}})
                        @endif
                    </p>
                    <p>Project aangemaakt op {{$project->AANGEMAAKTOP}}.</p>
                </div>
            </div>

            <div class="col-lg-6">
                <div style="height: 500px; width: 500px;">{!! Mapper::render () !!}</div>
            </div>


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
        @else
            <h3>Dit project bestaat niet of u heeft mogelijk geen toestemming om dit project te bekijken.</h3>
            <p>Klik <a href="/project">hier</a> om uw projecten te bekijken.</p>
        @endif
    </div>
</div>
@endsection
