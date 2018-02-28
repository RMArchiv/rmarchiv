@extends('layouts.app')
@section('pagetitle', 'Benutzer bannen')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if($user->isNotBanned())
                    {!! Form::open(['action' => ['UserBanController@ban', $user->id]]) !!}
                    <div class="card">
                        <div class="card-header">
                            Bannen von {{ $user->name }}
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="banreason">Grund des Banns *</label>
                                <input autocomplete="off" class="auto form-control" name="banreason" id="banreason" placeholder="" value=""/>
                            </div>
                        </div>
                        <div class="card-footer">
                            Dauer:
                            <input type="submit" name="aday" value="Ein Tag">
                            <input type="submit" name="aweek" value="Eine Woche">
                            <input type="submit" name="amonth" value="Ein Monat">
                            <input type="submit" name="forever" value="Permban">
                        </div>
                    </div>
                    {!! Form::close() !!}
                @else
                    {!! Form::open(['action' => ['UserBanController@unban', $user->id]]) !!}
                    <div class="card">
                        <div class="card-header">
                            Bann von {{ $user->name }} entfernen
                        </div>
                        <div class="card-body">
                            <p>Grund für Bann:</p>
                            <p>{{ $user->bans()->latest()->first()->comment }}</p>
                        </div>
                        <div class="card-footer">
                            <input type="submit" name="unban" value="Bann rückgängig">
                        </div>
                    </div>
                    {!! Form::close() !!}
                @endif
            </div>
        </div>
    </div>
@endsection