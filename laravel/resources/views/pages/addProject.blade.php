@extends('layout.app')
@section('title', '- Project Aanvragen')
@section('class', 'add-project')

@section('content-name')
Project aanvragen
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
                                <div style="height: 500px; width: 500px;">{!! Mapper::render () !!}</div>
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
