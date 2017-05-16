@extends('layout.app')
@section('title', '- Home')
@section('class', 'portfolio-page')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2>Projects</h2>
            </div>
            <div class="panel-body">
                @if(count($projects) > 0)
                    <h2>View all your projects</h2>
                    <div class="text-center">
                        @foreach($projects as $project)
                            <p>{{$project->KVKNUMMER}}</p>
                            <hr>
                            <div>
                                <h3>{{$project->OMSCHRIJVING}}<a href="/project/delete/{{$project->PROJECTID}}"><i class="fa fa-times" aria-hidden="true"></i></a></h3>
                                <p>{{$project->STATUS}}</p>
                            </div>
                        @endforeach
                        
                    </div>
                @else
                    <h2>You don't have any projects yet</h2>
                    <a href="/addproject">Go create one now!</a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
