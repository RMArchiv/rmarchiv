@extends('layouts.app')
@section('pagetitle', 'screenshot hinzufügen')
@section('content')
    <div id="content">
        <form action="{{ route('screenshot.upload', [$gameid, $screenid]) }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="rmarchivtbl" id="rmarchivbox_submitscreenshot">
                <h2>Screenshot hochladen</h2>

                @if (count($errors) > 0))
                <div class="rmarchivtbl errorbox">
                    <h2>Screenshot hochladen fehlgeschlagen</h2>
                    <div class="content">
                        @foreach ($errors->all() as $error)
                            <strong>{{ $error }}</strong>
                        @endforeach
                    </div>
                </div>
                @endif

                <div class="content">
                    <div class="formifier">
                        <div class="row" id="row_file">
                            <label for="file">Screenshot:</label>
                            <input name="file" id="file" type="file" value=""/>
                            <span> [<span class="req">req</span>] nur PNG!</span>
                        </div>
                    </div>
                </div>
                <div class="foot">
                    <input type="submit" value="{{ trans('app.misc.send') }}">
                </div>
            </div>
        </form>
    </div>
@endsection