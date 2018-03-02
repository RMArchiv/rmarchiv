@extends('layouts.app')
@section('pagetitle', trans('app.user_activities'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h1>{{ trans('app.user_activities') }}</h1>
                    {!! Breadcrumbs::render('user.activities') !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{ trans('app.user_activities') }}
                    </div>
                    <ul class="list-group list-group-flush">
                        @foreach($obyx as $o)
                            <li class="list-group-item">
                                <a href='{{ url('users', $o->user->id) }}' class='usera' title="{{ $o->user->name }}">
                                    <img width="32px" src='//{{ config('app.avatar_path') }}?gender=male&id={{ $o->user->id }}' alt="{{ $o->user->name }}" class='avatar'/> {{ $o->user->name }}
                                </a> :: <time datetime='{{ $o->created_at }}' title='{{ $o->created_at }}'>{{ \Carbon\Carbon::parse($o->created_at)->diffForHumans() }}</time>
                                <br>{!! $o->obyx->value !!} {{ trans('app.obyx_for') }}: {{ $o->obyx->reason_visible }}
                            </li>
                        @endforeach
                    </ul>
                    <div class="card-footer">
                        {{ $obyx->links('vendor.pagination.shoutbox') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection