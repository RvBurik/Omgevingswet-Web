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
                        <form role="form" action="{{ route('addProject') }}" method="get" id="newProjectForm">
                            <div class="form-group">
                                <label>Omschrijving van het project</label>
                                <input type="text" name="desc" id="desc" class="form-control"></input>
                            </div>

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



                                <!-- <div style="height: 500px; width: 500px;">{!! Mapper::render () !!}</div> -->
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- vergunningsvenster -->
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Bijbehorende vergunningen
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-6">
                        <form role="form">
                            <div class="form-group">
                                <label></label>
                                <input class="form-control" placeholder="Enter text">
                            </div>
                            <div class="form-group">
                                <label>Omschrijving van het project</label>
                                <textarea class="form-control" rows="5"></textarea>
                            </div>
                            <div class="form-group">
                                <label>File input</label>
                                <input type="file">
                            </div>

                            <button type="submit" class="btn btn-default">Submit Button</button>
                            <button type="reset" class="btn btn-default">Reset Button</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.col-lg-12 -->
</div>
@endsection

@section('scripts')
    <script src="{{asset('js/createMap.js')}}"></script>
@endsection
