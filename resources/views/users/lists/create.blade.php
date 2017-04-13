@extends('layouts.app')
@section('content')
    <div id="content">
        <form action="{{ url('lists/create') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="rmarchivtbl" id="rmarchivbox_submituserlist">
                <h2>{{ trans('user.lists.create.title') }}</h2>

                @if (count($errors) > 0))
                <div class="rmarchivtbl errorbox">
                    <h2>{{ trans('user.lists.create.error') }}</h2>
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
                            <label for="title">{{ trans('user.lists.create.list_title') }}:</label>
                            <input name="title" id="title" value=""/>
                            <span> [<span class="req">req</span>]</span>
                        </div>
                        <div class="row" id="row_desc">
                            <label for="desc">{{ trans('user.lists.create.desc') }}:</label>
                            <textarea name="desc" id="desc" maxlength="9999" rows="10" placeholder="{{ trans('user.lists.create.desc') }}"></textarea>
                            <span> [<span class="req">req</span>] Markdown!</span>
                        </div>
                    </div>
                </div>
                <div class="foot">
                    <input type="submit" value="{{ trans('user.lists.create.send') }}">
                </div>
            </div>
        </form>
    </div>
@endsection