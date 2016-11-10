@extends('layouts.app')

@section('content')
    <div id="content">
        <form action="{{ url('submit/logo') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="rmarchivtbl" id="rmarchivbox_submitavatar">
                <h2>{{ trans('app.submit.logo.title') }}</h2>

                @if (count($errors) > 0))
                <div class="rmarchivtbl errorbox">
                    <h2>{{ trans('app.submit.logo.error.title') }}</h2>
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
                            <label for="logoname">{{ trans('app.submit.logo.name') }}</label>
                            <input name="logoname" id="logoname" value=""/>
                            <span> [<span class="req">req</span>]</span>
                        </div>
                        <div class="row" id="row_file">
                            <label for="file">{{ trans('app.submit.logo.file') }}</label>
                            <input name="file" id="file" type="file" value=""/>
                            <span> [<span class="req">req</span>]</span>
                        </div>
                    </div>
                </div>
                <div class="foot">
                    <input type="submit" value="{{ trans('app.submit.logo.submit') }}">
                </div>
            </div>
        </form>
    </div>
@endsection