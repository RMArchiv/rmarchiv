@extends('layouts.app')
@section('pagetitle', trans('app.userlists'))
@section('content')
    <div class="container" id='content'>
        <div class="row">
            <div class="page-header">
                <h1>{{ trans('app.userlist') }}</h1>
                {!! Breadcrumbs::render('userlist.index', Auth::user()) !!}
            </div>
        </div>
        <table id='pouetbox_prodlist' class='table pagedtable'>
            <thead>
            <tr class='sortable'>
                <th>{{ trans('app.list') }}</th>
                <th>{{ trans('app.games') }}</th>
                <th>{{ trans('app.created_at') }}</th>
                <th>{{ trans('app.actions') }}</th>
            </tr>
            </thead>

            @foreach($lists as $list)
                <tr>
                    <td>
                        <a href="{{ action('UserListController@show', [$list->user_id, $list->id]) }}">{{ $list->title }}</a>
                    </td>
                    <td>
                        {{ $list->count }}
                    </td>
                    <td>
                        {{ $list->created_at }}
                    </td>
                    <td>
                        @if(Auth::check())
                            @if(Auth::id() == $list->user_id)
                                [<a href="#">{{ trans('app.delete') }}</a>]
                            @else
                                @role(('admin'))
                                [<a href="#">{{ trans('app.delete') }}</a>]
                                @endrole
                            @endif
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection