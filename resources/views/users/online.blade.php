@extends('layouts.app')
@section('pagetitle', trans('app.users_online'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="page-header">
                <h1>{{ trans('app.users_online') }}</h1>
                {!! Breadcrumbs::render('online') !!}
            </div>
        </div>
        <div class="row">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>
                        {{ trans('app.username') }}
                    </th>
                    <th>
                        {{ trans('app.last_page_visit') }}
                    </th>
                    <th>
                        {{ trans('app.last_action_date') }}
                    </th>
                </tr>
                </thead>
                @foreach($uo as $u)
                    <tr>
                        <td><a href="{{ action('UserController@show', $u->user_id) }}">{{ $u->user->name }}</a></td>
                        <td><a href="{{ $u->last_place }}">{{ $u->last_place }}</a></td>
                        <td>{{ $u->created_at }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection