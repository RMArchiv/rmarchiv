@extends('layouts.app')
@section('content')
    <div id="content">
        @if (count($errors) > 0)
            <div class="rmarchivtbl errorbox">
                <h2>board kategorie hinzufügen fehlgeschlagen</h2>
                <div class="content">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li><strong>{{ $error }}</strong></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

            @if($cats->count() <> 0)
                <h2>vorhandene kategorien</h2>
                <table id='pouetbox_prodlist' class='boxtable pagedtable'>
                    <thead>
                    <tr class='sortable'>
                        <th>titel</th>
                        <th>sortierung</th>
                        <th>erstellt am</th>
                        <th>threads</th>
                        <th>posts</th>
                        <th>aktionen</th>
                    </tr>
                    </thead>
                    @foreach($cats as $cat)
                        <tr>
                            <td>{{ $cat->cattitle }}</td>
                            <td>{{ $cat->catorder }}</td>
                            <td>{{ $cat->catdate }}</td>
                            <td>{{ $cat->catthreads }}</td>
                            <td>{{ $cat->catposts }}</td>
                            <td>
                                <a href="{{ route('board.cat.order', [$cat->catid, 'down']) }}"><img src="/assets/sort_up.png"></a> -
                                <a href="{{ route('board.cat.order', [$cat->catid, 'up']) }}"><img src="/assets/sort_down.png"></a> ::
                                @if($cat->catthreads == 0 and $cat->catposts == 0)
                                    <a href="#">[löschen]</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </table>
            @else
                <h2>bisher sind keine kategorien vorhanden.</h2>
            @endif

            {!! Form::open(['route' => ['board.cat.create']]) !!}
            <div class="rmarchivtbl" id="rmarchivbox_submitprod">
                <h2>hinzufügen einer forenkategorie</h2>

                <div class="content">
                    <div class="formifier">
                        <div class='row' id='row_name'>
                            <label for="name">kategorie name:</label>
                            <input name="name" id="name" value="" placeholder="allgemein"/>
                            <span> [<span class="req">req</span>]</span>
                        </div>
                        <div class="row" id="row_desc">
                            <label for="desc">kategorie beschreibung:</label>
                            <input name="desc" id="desc" value="" placeholder="alles tolle kommt hier rein"/>
                            <span> [<span class="req">req</span>]</span>
                        </div>
                    </div>
                </div>

                <div class="foot">
                    <input type="submit" value="senden">
                </div>
            </div>
            {!! Form::close() !!}
    </div>
@endsection