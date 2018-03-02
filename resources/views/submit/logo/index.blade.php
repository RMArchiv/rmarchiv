@extends('layouts.app')
@section('pagetitle', trans('app.add_logo'))
@section('content')
    <div id="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h1>{{ trans('app.add_logo') }}</h1>
                    {!! Breadcrumbs::render('logoadd') !!}
                </div>
            </div>
        </div>
        @if (count($errors) > 0))
        <div class="rmarchivtbl errorbox">
            <h2>{{ trans('app.add_logo_failed') }}</h2>
            <div class="content">
                @foreach ($errors->all() as $error)
                    <strong>{{ $error }}</strong>
                @endforeach
            </div>
        </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <form action="{{ url('submit/logo') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="card">
                        <div class="card-header">
                            {{ trans('app.add_logo') }}
                        </div>
                        <div class="card-body">
                            <div class="form-group" id="row_name">
                                <label for="logoname">{{ trans('app.name') }}</label>
                                <input class="form-control" name="logoname" id="logoname" value=""/>
                                <span> [<span class="req">req</span>]</span>
                            </div>
                            <div class="form-group" id="row_file">
                                <label for="file">{{ trans('app.file') }}</label>
                                <input class="form-control-file" name="file" id="file" type="file" value=""/>
                                <span> [<span class="req">req</span>]</span>
                            </div>
                        </div>
                        <div class="card-footer">
                            <input class="btn btn-default" type="submit" value="{{ trans('app.submit') }}">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection