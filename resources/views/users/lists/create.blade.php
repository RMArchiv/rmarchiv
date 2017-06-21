@extends('layouts.app')
@section('content')
    <div id="content">
        <form action="{{ url('lists/create') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="rmarchivtbl" id="rmarchivbox_submituserlist">
                <h2>{{ trans('app.create_userlist') }}</h2>

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

                <div class="content">
                    <div class="formifier">
                        <div class="row" id="row_type">
                            <label for="title">{{ trans('app.title') }}:</label>
                            <input name="title" id="title" value=""/>
                            <span> [<span class="req">req</span>]</span>
                        </div>
                        <div class="row" id="row_desc">
                            <label for="desc">{{ trans('app.description') }}:</label>
                            <textarea name="desc" id="desc" maxlength="9999" rows="10" placeholder="{{ trans('app.description') }}"></textarea>
                            <span> [<span class="req">req</span>] Markdown!</span>
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