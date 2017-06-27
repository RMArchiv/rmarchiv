@extends('layouts.app')
@section('pagetitle', trans('app.create_userlist'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="page-header">
                <h1>{{ trans('app.create_userlist') }}</h1>
                {!! Breadcrumbs::render('userlist.create', Auth::user()) !!}
            </div>
        </div>
        <div class="row">
            <form action="{{ url('lists/create') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2>{{ trans('app.create_userlist') }}</h2>
                    </div>
                    <div class="panel-body">
                        @if (count($errors) > 0))
                        <div class="rmarchivtbl errorbox">
                            <h2>{{ trans('app.create_userlist_error') }}</h2>
                            <div class="content">
                                @foreach ($errors->all() as $error)
                                    <strong>{{ $error }}</strong>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        <div class="form-group">
                            <label for="title">{{ trans('app.title') }}:</label>
                            <input name="title" id="title" value=""/>
                        </div>
                        <div class="form-group">
                            <label for="desc">{{ trans('app.description') }}:</label>
                            <textarea name="desc" id="desc" maxlength="9999" rows="10" placeholder="{{ trans('app.description') }}"></textarea>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <div class="pull-right">
                            <input type="submit" value="{{ trans('app.submit') }}">
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection