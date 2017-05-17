@extends('layout.app')
@section('title', '- Project')
@section('class', 'portfolio-page')

@section('content')
<div class="row">
    <div class="col-lg-12">
        @if (!empty($project))
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2>Projectinformatie</h2>
                </div>
                <div class="panel-body">
                    <p>{{$project->WERKZAAMHEID}}</p>
                </div>
            </div>
            <div class="panel panel-default">
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
            <h2>Dit project bestaat niet. Klik <a href="/project">hier</a> om uw projecten te bekijken.
        @endif
    </div>
</div>
@endsection
