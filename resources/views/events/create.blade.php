@extends('layouts.app')
@section('pagetitle', 'event erstellen')
@section('content')
    <link rel="stylesheet" href="https://unpkg.com/flatpickr/dist/flatpickr.min.css">
    <script src="https://npmcdn.com/flatpickr/dist/flatpickr.min.js"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/de.js"></script>
    <div id="content">
        <form action="{{ action('EventController@store') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="rmarchivtbl" id="rmarchivbox_submitnews">
                <h2>event anlegen</h2>

                @if (count($errors) > 0))
                <div class="rmarchivtbl errorbox">
                    <h2>event konnte nicht angelegt werden</h2>
                    <div class="content">
                        @foreach ($errors->all() as $error)
                            <strong>{{ $error }}</strong>
                        @endforeach
                    </div>
                </div>
                @endif

                <div class="content">
                    <div class="formifier">
                        <div class="row" id="row_type">
                            <label for="title">titel:</label>
                            <input name="title" id="title" value="" placeholder="Opel-Treff 2004"/>
                            <span> [<span class="req">req</span>]</span>
                        </div>
                        <div class="row" id="row_desc">
                            <label for="desc">beschreibung:</label>
                            <textarea name="desc" id="desc" maxlength="9999" rows="10" placeholder="eventbeschreibung"></textarea>
                            <span> [<span class="req">req</span>] Markdown!</span>
                        </div>
                        <div class="row" id="row_slots">
                            <label for="slots">anzahl der möglichen anmeldungen:</label>
                            <input name="slots" id="slots" value="" placeholder="anzahl (0 = unbegrenzt)"/>
                            <span> [<span class="req">req</span>]</span>
                        </div>
                        <div class="row" id="row_start">
                            <label for="start">beginn des events:</label>
                            <input class="start" name="start" id="start" type="text"/>
                            <span> [<span class="req">req</span>]</span>
                        </div>
                        <div class="row" id="row_end">
                            <label for="end">ende des events:</label>
                            <input class="end" name="end" id="end" type="text"/>
                            <span> [<span class="req">req</span>]</span>
                        </div>
                    </div>
                </div>
                <div class="foot">
                    <input type="submit" value="event einsenden">
                </div>
            </div>
        </form>
    </div>
    <script>
        $(".start").flatpickr({
            enableTime: true,
            time_24hr: true
        });
        $(".end").flatpickr({
            enableTime: true,
            time_24hr: true
        });
    </script>
@endsection