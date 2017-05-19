@extends('layout.app')
@section('title', '- Vergunningen')
@section('class', 'portfolio-page')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2>Vergunningen</h2>
            </div>
            <div class="panel-body">
                @if(count($permits) > 0)
                    <h2>View all your vergunningen</h2>
                    <div class="text-center">
                        @foreach($permits as $permit)
                            <hr>
                            <div>
                                <h3>{{$permit->project()->WERKZAAMHEID}} - {{$permit->VERGUNNINGSNAAM}} - {{$permit->OMSCHRIJVING}}<a href="/project/{{$permit->PROJECTID}}">(project  {{$permit->PROJECTID}})</a></h3>
                                <p>{{$permit->STATUS}}</p>
                            </div>
                        @endforeach
                    </div>
                @else.
                    <h2>U hebt nog geen vergunningen aangevraagd. U kunt dit doen via het <a href="/project">projectenoverzicht</a>.</h2>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
