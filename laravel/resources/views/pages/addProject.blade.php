@extends('layout.app')
@section('title', '- Project Aanvragen')
@section('class', 'add-project')

@section('content-name')
Project Aanvragen
@endsection

@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                Vul de gegevens van uw aanvraag in
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-6">
                        <form role="form" action="{{ route('addProject') }}" method="post" id="newProjectForm">
                            <div class="form-group">
                                <label>Titel het project</label>
                                <input type="text" name="titel" id="titel" class="form-control"></input>
                            </div>
                            <div class="form-group">
                                <label>Omschrijving van het project</label>
                                <input type="text" name="desc" id="desc" class="form-control"></input>
                            </div>
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-default">Submit Button</button>
                            <button type="reset" class="btn btn-default">Reset Button</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- Rechterkant van het scherm, includes map -->
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                Kies de locatie van het project
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-6">
                        <form role="form">
                            <div class="form-group">

                                <label></label>
                                <a class="skiplink" href="#map">Go to map</a>
                                <div id="map" class="map" tabindex="0" style="height: 500px; width:500px;"></div>

                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="{{asset('js/createMap.js')}}"></script>
@endsection
