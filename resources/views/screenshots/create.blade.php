@extends('layouts.app')
@section('pagetitle', 'Screenshot hinzufügen')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h1>{{trans('app.upload.screenshot')}}</h1>
                    {!! Breadcrumbs::render('game-screenshot', $game, $screenid) !!}
                </div>
            </div>
        </div>
        <div class="row">
            @if (count($errors) > 0))
            <div class="card">
                <div class="card-header">Screenshot hochladen fehlgeschlagen</div>
                <div class="card-body">
                    @foreach ($errors->all() as $error)
                        <strong>{{ $error }}</strong>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('screenshot.upload', [$gameid, $screenid]) }}" method="post"
                      enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="card">
                        <div class="card-header">
                            {{trans('app.upload.screenshot')}}
                        </div>
                        <div class="card-body">
                            <div class="form-group" id="row_file">
                                <label for="file">{{trans('app.screenshot')}}:</label>
                                <input class="form-control form-control-file" name="file" id="file" type="file" value="" required/>
                                <span> [<span class="req">req</span>] nur PNG!</span>
                            </div>
                        </div>
                        <div class="card-footer">
                            <input class="btn btn-primary" type="submit" value="{{ trans('app.submit') }}">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection