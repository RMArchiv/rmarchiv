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
                        <div class="row" id="row_start">
                            <label for="start">beginn des events:</label>
                            <input class="start" name="start" id="start" value="" type="text"/>
                            <span> [<span class="req">req</span>]</span>
                        </div>
                        <div class="row" id="row_end">
                            <label for="end">ende des events:</label>
                            <input class="end" name="end" id="end" value="" type="text"/>
                            <span> [<span class="req">req</span>]</span>
                        </div>
                    </div>
                </div>
                <h2>anmeldungseinstellungen</h2>
                <div class="content">
                    <div class="formifier">
                        <div class="row" id="row_slots">
                            <label for="slots">anzahl der möglichen anmeldungen:</label>
                            <input name="slots" id="slots" value="" placeholder="anzahl (0 = unbegrenzt)"/>
                            <span> [<span class="req">req</span>]</span>
                        </div>
                        <div class="row" id="row_price">
                            <label for="price">anmeldegebühr:</label>
                            <input name="price" id="price" value="" placeholder="Betrag in €"/>
                        </div>
                        <div class="row" id="row_reg_allowed">
                            <label for="reg_start">anmeldung geöffnet:</label>
                            <input type="checkbox" name="reg_allowed" id="reg_allowed"  />
                            wenn deaktiviert, werden untere zeiten ignoriert!
                        </div>
                        <div class="row" id="row_reg_start">
                            <label for="reg_start">beginn des nnmeldezeitraumes:</label>
                            <input class="reg_start" name="reg_start" id="reg_start" value="" type="text"/>
                        </div>
                        <div class="row" id="row_reg_end">
                            <label for="reg_end">ende des anmeldezeitraumes:</label>
                            <input class="reg_end" name="reg_end" id="reg_end" value="" type="text"/>
                        </div>
                    </div>
                </div>
                <div class="foot">
                    <input type="submit" value="änderungen speichern">
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
        $(".reg_end").flatpickr({
            enableTime: true,
            time_24hr: true
        });
        $(".reg_start").flatpickr({
            enableTime: true,
            time_24hr: true
        });
    </script>
@endsection