@extends('layouts.app')
@section('pagetitle', trans('app.add_logo'))
@section('content')
    <div id="content">
        <form action="{{ url('submit/logo') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="rmarchivtbl" id="rmarchivbox_submitavatar">
                <h2>{{ trans('app.add_logo') }}</h2>

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

                <div class="content">
                    <div class="formifier">
                        <div class="row" id="row_name">
                            <label for="logoname">{{ trans('app.name') }}</label>
                            <input name="logoname" id="logoname" value=""/>
                            <span> [<span class="req">req</span>]</span>
                        </div>
                        <div class="row" id="row_file">
                            <label for="file">{{ trans('app.file') }}</label>
                            <input name="file" id="file" type="file" value=""/>
                            <span> [<span class="req">req</span>]</span>
                        </div>
                    </div>
                </div>
                <div class="foot">
                    <input type="submit" value="{{ trans('app.submit') }}">
                </div>
            </div>
        </form>
    </div>
@endsection