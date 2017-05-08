@extends('layouts.app')
@section('pagetitle', 'benutzer')
@section('content')
    <script>
        $(document).ready(function () {
            var panels = $('.user-infos');
            var panelsButton = $('.dropdown-user');
            panels.hide();

            //Click dropdown
            panelsButton.click(function () {
                //get data-for attribute
                var dataFor = $(this).attr('data-for');
                var idFor = $(dataFor);

                //current button
                var currentButton = $(this);
                idFor.slideToggle(400, function () {
                    //Completed slidetoggle
                    if (idFor.is(':visible')) {
                        currentButton.html('<i class="fa fa-chevron-up text-muted"></i>');
                    }
                    else {
                        currentButton.html('<i class="fa fa-chevron-down text-muted"></i>');
                    }
                })
            });

            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

    <div class="container">
        <div class="row">
            <div class="page-header">
                <h1>benutzer</h1>
                {!! Breadcrumbs::render('users') !!}
            </div>
        </div>
        <div class="row">
            {{ $users->links('vendor.pagination.bootstrap-4') }}
            <div class="panel panel-default">
                <div class="panel-heading">
                    benutzerliste
                </div>
                <div class="panel-body">
                    @foreach($users as $user)
                        <div class="row user-row">
                            <div class="col-xs-3 col-sm-2 col-md-1 col-lg-1">
                                <a href='{{ url('users', $user->id) }}' class='usera' title="{{ $user->name }}"><img class="img-rounded"
                                     width="50px"
                                     src="http://ava.rmarchiv.de/?size=50&gender=male&id={{ $user->id }}"
                                                                                                                             alt="User Pic"></a>
                            </div>
                            <div class="col-xs-8 col-sm-9 col-md-10 col-lg-10">
                                <strong><a href='{{ url('users', $user->id) }}' class='usera' title="{{ $user->name }}">{{ $user->name }}</a></strong><br>
                                <span class="text-muted">{{ trans('user.index.level') }}: <span title="{{ $user->roles[0]->display_name }}">{{ $user->roles[0]->display_name }}</span></span>
                            </div>
                            <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 dropdown-user" data-for=".{{ $user->name }}">
                                <i class="fa fa-chevron-down text-muted"></i>
                            </div>
                        </div>
                        <div class="row user-infos {{ $user->name }}">
                            <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 col-xs-offset-0 col-sm-offset-0 col-md-offset-1 col-lg-offset-1">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">benutzerinformationen</h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-3 col-lg-3 hidden-xs hidden-sm">
                                                <img class="img-rounded"
                                                     width="100px"
                                                     src="http://ava.rmarchiv.de/?size=100&gender=male&id={{ $user->id }}"
                                                     alt="User Pic">
                                            </div>
                                            <div class="col-xs-2 col-sm-2 hidden-md hidden-lg">
                                                <img class="img-rounded"
                                                     width="50px"
                                                     src="http://ava.rmarchiv.de/?size=50&gender=male&id={{ $user->id }}"
                                                     alt="User Pic">
                                            </div>
                                            <div class="col-xs-10 col-sm-10 hidden-md hidden-lg">
                                                <strong><a href='{{ url('users', $user->id) }}' class='usera' title="{{ $user->name }}">{{ $user->name }}</a></strong><br>
                                                <dl>
                                                    <dt>{{ trans('user.index.level') }}:</dt>
                                                    <dd><span title="{{ $user->roles[0]->display_name }}">{{ $user->roles[0]->display_name }}</span></dd>
                                                    <dt>{{ trans('user.index.member_since') }}:</dt>
                                                    <dd>{{ $user->created_at }}</dd>
                                                    <dt>posts:</dt>
                                                    <dd>0</dd>
                                                </dl>
                                            </div>
                                            <div class=" col-md-9 col-lg-9 hidden-xs hidden-sm">
                                                <strong><a href='{{ url('users', $user->id) }}' class='usera' title="{{ $user->name }}">{{ $user->name }}</a></strong><br>
                                                <table class="table table-user-information">
                                                    <tbody>
                                                    <tr>
                                                        <td>{{ trans('user.index.level') }}:</td>
                                                        <td><span title="{{ $user->roles[0]->display_name }}">{{ $user->roles[0]->display_name }}</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td>{{ trans('user.index.member_since') }}:</td>
                                                        <td>{{ $user->created_at }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>posts:</td>
                                                        <td>{{ $user->boardposts->count() }}</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-footer">
                                        @if(Auth::check())
                                            <button class="btn btn-sm btn-primary" type="button"
                                                    data-toggle="tooltip"
                                                    data-original-title="Send message to user"><i class="fa fa-envelope"></i>
                                            </button>
                                        @endif
                                        <span class="pull-right">
                                            @if(Auth::check())
                                                @if(Auth::user()->settings->is_admin)
                                                    <button class="btn btn-sm btn-warning" type="button"
                                                            data-toggle="tooltip"
                                                            data-original-title="Edit this user"><i class="fa fa-edit"></i></button>
                                                    <button class="btn btn-sm btn-danger" type="button"
                                                            data-toggle="tooltip"
                                                            data-original-title="Remove this user"><i class="fa fa-remove"></i></button>
                                                @endif
                                            @endif

                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            {{ $users->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
@endsection