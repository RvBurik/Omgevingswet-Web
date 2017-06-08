@extends('layout.app')
@section('title', '- Home')
@section('class', 'portfolio-page')

@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2>Projects</h2>
            </div>
            <div class="panel-body">
                @if(count($allProjects) > 0)
                    <h2>Alle projecten</h2>
                    <div class="text-center">
                        @foreach($allProjects as $project)
                            <hr>
                            <div>
                                <h3>Project #{{$project->PROJECTID}} - {{$project->PROJECTTITEL}}</h3>
                                <h4>{{ $project->WERKZAAMHEID }}
                                <h5>Aangevraagd op {{ $project->AANGEMAAKTOP }}</h5>
                                <h5>Coördinator: {{ $project->GEBRUIKERSNAAM }}</h5>

                                <form class="form-horizontal" role="form" method="POST" action="{{ route('subscription') }}">
                                    {{ csrf_field() }}
                                    <input id="PROJECTID" type="hidden" class="form-control" name="PROJECTID" value="{{ $project->PROJECTID }}" required>
                                  <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Terug</button> -->
                                    <button type="submit" class="btn btn-primary">Abonneren</button>
                                </form>
                            </div>
                        @endforeach

                    </div>
                @else
                    <h2>Op dit moment zijn er geen geregistreerde projecten!</h2>
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-bar-chart-o fa-fw"></i> Locatie
            </div>

            <div style="height: 500px; width: 500px;">{!! Mapper::render () !!}</div>

            <div class="panel-body">
                <div id="morris-area-chart"></div>
            </div>
        </div>
    </div>

</div>
@endsection
