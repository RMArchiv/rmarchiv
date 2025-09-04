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
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary d-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#{{ 'modal-' . $list->id}}">
                                    <i class="fa fa-trash"></i><span>{{ trans('app.delete') }}</span>
                                </button>
                            @else
                                @role(('admin'))
                                <button type="button" class="btn btn-primary d-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#{{ 'modal-' . $list->id}}">
                                    <i class="fa fa-trash"></i><span>{{ trans('app.delete') }}</span>
                                </button>
                                @endrole
                            @endif
                        @endif
                    </td>
                </tr>


                <!-- Modal -->
                <div class="modal fade" id="{{'modal-' . $list->id}}" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalLabel">{{ trans('app.delete')}}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="d-flex gap-2">
                            <div class="d-flex pe-2 flex-column border-end">
                                <div>{{trans('app.name')}}</div>
                                <div>{{trans('app.games')}}</div>
                            </div>
                            <div class="d-flex flex-column">
                                <div>{{ $list->title}}</div>
                                <div>{{ $list->count}}</div>
                            </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <a href=" {{ action('UserListController@delete', $list->id) }}" type="button" class="btn btn-warning d-flex align-items-center gap-1">
                            <i class="fa fa-trash"></i><span>{{ trans('app.delete') }}</span>
                        </a>
                    </div>
                    </div>
                </div>
                </div>
            @endforeach
        </table>
    </div>
@endsection