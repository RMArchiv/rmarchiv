@extends('layouts.app')
@section('pagetitle', 'spiel melden')
@section('content')
    <div id="content">
        <form action="{{ url('reports/add/game', $game->id) }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="rmarchivtbl" id="rmarchivbox_submitnews">
                <h2>{{ trans('app.news.add.title') }}</h2>

                @if (count($errors) > 0))
                <div class="rmarchivtbl errorbox">
                    <h2>{{ trans('app.news.add.error.title') }}</h2>
                    <div class="content">
                        @foreach ($errors->all() as $error)
                            <strong>{{ $error }}</strong>
                        @endforeach
                    </div>
                </div>
                @endif

                <div class="content">
                    <div class="formifier">
                        <div class="row" id="row_message">
                            <label for="msg">begründung:</label>
                            <textarea name="msg" id="msg" maxlength="9999" rows="10" placeholder="warum soll das spiel gemeldet werden?"></textarea>
                            <span> [<span class="req">req</span>] Markdown!</span>
                        </div>
                    </div>
                </div>
                <div class="foot">
                    <input type="submit" value="report einsenden">
                </div>
            </div>
        </form>
    </div>
@endsection