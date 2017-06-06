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
                                <!-- Hier moet een form komen voor het abonneren -->
                                <h3><a href="/project/{{$project->PROJECTID}}">Project #{{$project->PROJECTID}} - {{$project->WERKZAAMHEID}}</a></h3>
                                <h5>Aangevraagd op {{ $project->AANGEMAAKTOP }}</h5>
                            </div>
                        @endforeach

                    </div>
                @else
                    <h2>Op dit moment zijn er geen geregistreerde projecten!</h2>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
