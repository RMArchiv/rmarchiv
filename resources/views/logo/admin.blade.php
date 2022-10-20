@extends('layouts.app')
@section('pagetitle', 'Logo admin')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h1>Logo Administration</h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Logos
                    </div>
                    <table class='table table-striped'>
                        <thead>
                        <tr class="active">
                            <th>Logo</th>
                            <th>Good</th>
                            <th>Bad</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        @foreach($logos as $l)
                            <tr>
                                <td><img class="mx-auto d-block" height="100px" src="{{ route('logo.show', $l->id) }}" alt="Logo: {{ $l->title }}"/></td>
                                <td></td>
                                <td></td>
                                <th><a href="{{ action('LogoController@delete', $l->id) }}">Löschen</a></th>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection