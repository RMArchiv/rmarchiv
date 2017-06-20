@extends('layouts.app')
@section('pagetitle', trans('app.report_game'))
@section('content')
    <div id="content">
        <form action="{{ url('reports/add/game', $game->id) }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="rmarchivtbl" id="rmarchivbox_submitnews">
                <h2>{{ trans('app.report_game') }}</h2>

                @if (count($errors) > 0))
                <div class="rmarchivtbl errorbox">
                    <h2>{{ trans('app.report_game_error') }}</h2>
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
                            <label for="msg">{{ trans('app.report_description') }}:</label>
                            <textarea name="msg" id="msg" maxlength="9999" rows="10" placeholder="{{ trans('app.report_description_placeholder') }}"></textarea>
                            <span> [<span class="req">req</span>] Markdown!</span>
                        </div>
                    </div>
                </div>
                <div class="foot">
                    <input type="submit" value="{{ trans('app.submit') }}">
                </div>
            </div>
        </form>
    </div>
@endsection