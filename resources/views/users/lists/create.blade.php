@extends('layouts.app')
@section('content')
    <div id="content">
        <form action="{{ url('lists/create') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="rmarchivtbl" id="rmarchivbox_submituserlist">
                <h2>Userliste erstellen</h2>

                @if (count($errors) > 0))
                <div class="rmarchivtbl errorbox">
                    <h2>Fehler beim erstellen der Userliste</h2>
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
                            <input name="title" id="title" value=""/>
                            <span> [<span class="req">req</span>]</span>
                        </div>
                        <div class="row" id="row_desc">
                            <label for="desc">beschreibung:</label>
                            <textarea name="desc" id="desc" maxlength="9999" rows="10" placeholder="Beschreibung"></textarea>
                            <span> [<span class="req">req</span>] Markdown!</span>
                        </div>
                    </div>
                </div>
                <div class="foot">
                    <input type="submit" value="Liste erstellen">
                </div>
            </div>
        </form>
    </div>
@endsection