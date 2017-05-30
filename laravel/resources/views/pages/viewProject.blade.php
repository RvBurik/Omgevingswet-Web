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
                <div class="panel-body"
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

                <div class="panel-heading">
                    <h2>Bezwaar</h2>
                </div>
                <div class="panel-body">
                    <p>Bent u het niet eens met bovenstaand project? Laat het ons weten door bezwaar te maken!</p>
                </div>
                <div class="form-group">
                    <a class="btn btn-link" href="/project/bezwaar/{{$project->PROJECTID}}">Bezwaar maken </a>

                </div>
            </div>

            <div class="panel panel-default col-lg-5 col-md-offset-1">
                <div class="panel-heading">
                    <h2>Locatie</h2>
                </div>
                <div class="panel-body">
                    <div class="col-lg-6">
                        <div style="height: 500px; width: 500px;">{!! Mapper::render () !!}</div>
                    </div>
                </div>
            </div>

            </div>
            <div class="panel panel-default col-lg-12">
                <div class="panel-heading">
                    <h2>Vergunningsinformatie</h2>
                </div>
                <div class="panel-body">
                    @if ($project->mayUserAddInfo(Auth::user()))
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3>Informatiestuk toevoegen</h3>
                            </div>
                            <div class="panel-body">
                                <form role="form" action="{{ route('addPermitInfo') }}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="project" value="{{$project->PROJECTID}}">
                                    <div class="form-group">
                                        <label>Uitleg</label>
                                        <textarea class="form-control" name="description" rows="5"></textarea>
                                    </div>
                                     <div class="form-group">
                                        <label>Bijlage</label>
                                        <input class="form-control" name="attachmentLocation" placeholder="Voeg een link toe...">
                                    </div>
                                    <div class="form-group">
                                        <label>Bestand uploaden</label>
                                        <input type="file" name="attachmentFile">
                                    </div>
                                    <button type="submit" class="btn btn-default">Submit</button>
                                    <button type="reset" class="btn btn-default">Reset</button>
                                </form>
                            </div>
                        </div>
                    @endif
                    @foreach ($project->permitInfos as $permitInfo)
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 id="permit-info-{{$permitInfo->VOLGNUMMER}}">Informatiestuk {{$permitInfo->VOLGNUMMER}}</h3>
                            </div>
                            <div class="panel-body">
                                <p>{{$permitInfo->UITLEG}}</p>
                                @if ($permitInfo->hasValidFile())
                                    @if ($permitInfo->isImage())
                                        <img src="{{$permitInfo->downloadLink()}}">
                                    @endif
                                    <p><a href="{{$permitInfo->downloadLink()}}">Download {{$permitInfo->shortFileName()}} ({{$permitInfo->fileSizeString()}})</a></p>
                                @endif
                                <p><i>Toegevoegd door <b>{{$permitInfo->user->fullName()}}</b> op {{$permitInfo->DATUM}}</i></p>
                            </div>
                        </div>
                    @endforeach
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
                                    <!-- <br>{{$permitInfo->user->getUserName()}}</br>
                                    <br>{{Auth::user()}}</br> -->
                                    @if ($permit->STATUS !== 'Verlopen' && $permitInfo->user->getUserName() !== Auth::user()->GEBRUIKERSNAAM)
                                    <a class="btn btn-link" href="/project/bezwaar/vergunning/{{$permit->VERGUNNINGSID}}">Bezwaar maken </a>
                                    @endif
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
