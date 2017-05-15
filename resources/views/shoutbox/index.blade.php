@extends('layouts.app')
@section('pagetitle', 'shoutbox historie')
@section('content')
    <div class="container">
        <div class="row">
            <div class="page-header">
                <h1>die komplette shoutbox historie</h1>
                {!! Breadcrumbs::render('shoutbox') !!}
            </div>
        </div>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ $shoutbox->links('vendor.pagination.bootstrap-4') }}
                </div>
                <ul class="list-group">
                    @foreach($shoutbox as $shout)
                        <li class="list-group-item clearfix">
                            <a href='{{ url('users' , $shout->user->id) }}' class='usera' title="{{ $shout->user->name }}">
                                <img width="16px" src='http://ava.rmarchiv.de/?gender=male&id={{ $shout->user->id  }}' alt="{{ $shout->user->name }}" class='avatar' /> {{ $shout->user->name }}
                            </a> :: <time datetime='{{ $shout->created_at }}' title='{{ $shout->created_at }}'>{{ \Carbon\Carbon::parse($shout->created_at)->diffForHumans() }}</time>
                            {!! $shout->shout_html !!}
                        </li>
                    @endforeach
                </ul>
                <div class="panel-footer">
                    {{ $shoutbox->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection