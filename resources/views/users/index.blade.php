@extends('layouts.app')
@section('pagetitle', trans('app.users'))
@section('content')
    <script type="module">
        document.addEventListener('DOMContentLoaded', function() {
            var panels = document.querySelectorAll('.user-infos');
            var panelsButton = document.querySelectorAll('.dropdown-user');
            panels.forEach((panel) => {
                panel.style.maxHeight = "0px"
                panel.style.visibility = "hidden"
                panel.style.transition= "max-height 0.2s ease";
                panel.style.overflow= "hidden";
            });

            //Click dropdown
            panelsButton.forEach((button) => {
                button.addEventListener("click", function(event) {
                    //get data-for attribute
                    var dataFor = event.currentTarget.dataset.for;
                    /** @type HTMLDivElement idFor            */
                    var idFor = document.querySelector(dataFor);

                    //current button
                    var currentButton = event.currentTarget.children[0];

                    if(idFor.style.visibility == "hidden") {
                        idFor.style.visibility = "visible"
                        idFor.style.maxHeight = "700px";
                    } else {
                        idFor.style.visibility = "hidden"
                        idFor.style.maxHeight = "0px";
                    }
                    setTimeout(()=>{
                        if (currentButton.classList.contains('fa-chevron-up')) {
                            currentButton.classList.add('fa-chevron-down')
                            currentButton.classList.remove('fa-chevron-up')
                        }
                        else {
                            currentButton.classList.add('fa-chevron-up')
                            currentButton.classList.remove('fa-chevron-down')
                        }
                    }, 50)
                });
                // Activate tooltip
                var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
                var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
                })
            })
        });
    </script>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h1>{{ trans('app.users') }}</h1>
                    {!! Breadcrumbs::render('users') !!}
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                {{ $users->links('vendor.pagination.bootstrap-4') }}
            </div>
            <div class="col-md-12">
                <div class="">
                    <div class="card-body">
                        @foreach($users as $user)
                            <div class="row user-row">
                                <div class="col-xs-3 col-sm-2 col-md-1 col-lg-1">
                                    <a href='{{ url('users', $user->id) }}' class='usera' title="{{ $user->name }}"><img class="img-rounded"
                                                                                                                         width="50px"
                                                                                                                         src="//{{ config('app.avatar_path') }}?size=50&gender=male&id={{ $user->id }}"
                                                                                                                         alt="User Pic"></a>
                                </div>
                                <div class="col-xs-8 col-sm-9 col-md-10 col-lg-10">
                                    <strong><a href='{{ url('users', $user->id) }}' class='usera' title="{{ $user->name }}">{{ $user->name }}</a></strong><br>
                                    <span class="text-muted">{{ trans('app.level') }}: <span title="{{ $user->roles[0]->display_name }}">{{ $user->roles[0]->display_name }}</span></span>
                                </div>
                                <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 dropdown-user" data-for=".user{{ $user->id }}">
                                    <i class="fa fa-chevron-down text-muted"></i>
                                </div>
                            </div>
                            <div class="row user-infos d-flex justify-content-end mb-4 hidden user{{ $user->id }}" style="max-height: 0px; visibility:hidden">
                                <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 col-xs-offset-0 col-sm-offset-0 col-md-offset-1 col-lg-offset-1">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">{{ trans('app.userinformation') }}</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-3 col-lg-3 hidden-xs hidden-sm">
                                                    <img class="img-rounded"
                                                         width="100px"
                                                         src="//{{ config('app.avatar_path') }}?size=100&gender=male&id={{ $user->id }}"
                                                         alt="User Pic">
                                                </div>
                                                <div class="col-xs-2 col-sm-2 hidden-md hidden-lg">
                                                    <img class="img-rounded"
                                                         width="50px"
                                                         src="//{{ config('app.avatar_path') }}?size=50&gender=male&id={{ $user->id }}"
                                                         alt="User Pic">
                                                </div>
                                                <div class="col-xs-10 col-sm-10 hidden-md hidden-lg">
                                                    <strong><a href='{{ url('users', $user->id) }}' class='usera' title="{{ $user->name }}">{{ $user->name }}</a></strong><br>
                                                    <dl>
                                                        <dt>{{ trans('app.level') }}:</dt>
                                                        <dd><span title="{{ $user->roles[0]->display_name }}">{{ $user->roles[0]->display_name }}</span></dd>
                                                        <dt>{{ trans('app.registered_since') }}:</dt>
                                                        <dd>{{ $user->created_at }}</dd>
                                                        <dt>{{ trans('app.board_posts') }}</dt>
                                                        <dd>{{ $user->boardposts->count() }}</dd>
                                                    </dl>
                                                </div>
                                                <div class=" col-md-9 col-lg-9 hidden-xs hidden-sm">
                                                    <strong><a href='{{ url('users', $user->id) }}' class='usera' title="{{ $user->name }}">{{ $user->name }}</a></strong><br>
                                                    <table class="table table-user-information">
                                                        <tbody class="text-capitalize">
                                                        <tr>
                                                            <td>{{ trans('app.level') }}:</td>
                                                            <td><span title="{{ $user->roles[0]->display_name }}">{{ $user->roles[0]->display_name }}</span></td>
                                                        </tr>
                                                        <tr>
                                                            <td>{{ trans('app.registered_since') }}:</td>
                                                            <td>{{ $user->created_at }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>{{ trans('app.board_posts')}}</td>
                                                            <td>{{ $user->boardposts->count() }}</td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            @if(Auth::check())
                                                <a class="btn btn-sm btn-primary" href="{{action('MessagesController@create', ['preselect' => array($user->id)])}}" type="button"
                                                        data-bs-toggle="tooltip"
                                                        title="{{ trans('app.send_a_pn') }}">
                                                    <i class="fa fa-envelope"></i>
                                                </a>
                                            @endif
                                            <span class="float-end">
                                            @if(Auth::check())
                                                    @if(Auth::user()->settings->is_admin)
                                                        <button class="btn btn-sm btn-warning" type="button"
                                                                data-bs-toggle="tooltip"
                                                                title="{{ trans('app.edit') }}"><i class="fa fa-edit"></i></button>
                                                        <button class="btn btn-sm btn-danger" type="button"
                                                                data-bs-toggle="tooltip"
                                                                title="{{ trans('app.delete') }}"><i class="fa fa-remove"></i></button>
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
            </div>
            <div class="card-footer col-md-12">
                {{ $users->links('vendor.pagination.bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection