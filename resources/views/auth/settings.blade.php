@extends('layouts.app')
@section('pagetitle', trans('app.user_settings'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h1>{{ trans('app.user_settings') }}</h1>
                    {!! Breadcrumbs::render('impressum') !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mb-3">
                <form action="//{{ config('app.avatar_path') }}/upload.php" method="post" enctype="multipart/form-data">
                    <div class="card">
                        <input type="hidden" name="posttype" value="avatar">
                        <input type="hidden" name="userid" value="{{ Auth::id() }}">
                        <div class="card-header">
                            {{ trans('app.avatar_upload') }}
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="file">{{ trans('app.upload_file') }}</label>
                                <input type="file" id="file" name="file">
                                <p class="form-text">160*160px MAX! (gif,png,jpg)</p>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="pull-right">
                                <input class="btn btn-primary" type="submit" id="submit"
                                       value="{{ trans('app.submit') }}">
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mb-3">
                {!! Form::open(['action' => ['UserSettingsController@change_language']]) !!}
                <div class="card">
                    <div class="card-header">
                        {{ trans('app.language') }}
                    </div>
                    <div class="card-body">
                        <div class='form-group'>
                            <label class="col-lg-2 col-form-label" for='language'>{{trans('app.language')}} *</label>
                            <div class="col-lg-10">
                                <select name='language' id='language' class="form-control">
                                    <option @if(Auth::user()->settings->language == 'de') selected="selected"
                                            @endif value="de">deutsch
                                    </option>
                                    <option @if(Auth::user()->settings->language == 'en') selected="selected"
                                            @endif value="en">english
                                    </option>
                                    <option @if(Auth::user()->settings->language == 'es') selected="selected"
                                            @endif value="es">español
                                    </option>

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="pull-right">
                            <input class="btn btn-primary" type="submit" id="submit" value="{{ trans('app.submit') }}">
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mb-3">
                {!! Form::open(['action' => ['UserSettingsController@change_download_template']]) !!}
                <div class="card">
                    <div class="card-header">
                        Download file template
                    </div>
                    <div class="card-body">
                        <div class='form-group'>
                            <div class="col-lg-10">
                                <div class="form-group">
                                    <label for="download_template">Download template: </label>
                                    <input name="download_template" id="download_template" type="text" value="{{ $settings->download_template }}"/>
                                    <small id="download_templateHelp" class="form-text text-muted">
                                        Possible Strings:<br>
                                        {title} - Gametitle<br>
                                        {subtitle} - Game Subtitle<br>
                                        {reltype} - Demo/Fullversion<br>
                                        {relversion} - Version Number<br>
                                        {relday} - Release Day<br>
                                        {relmonth} - Month<br>
                                        {relyear} - Year<br>
                                        {ext} - Fileextension<br>
                                        <br>
                                        Example: {title} - {subtitle} [{reltype} {relversion} -
                                        {relyear}-{relmonth}-{relday}].{ext}
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="pull-right">
                            <input class="btn btn-primary" type="submit" id="submit" value="{{ trans('app.submit') }}">
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mb-3">
                <div class="card">
                    <div class="card-header">
                        {{ trans('app.indexpage_widget_settings') }}
                    </div>
                    <ul class="list-group">
                        @foreach(Schema::getColumnListing('user_settings') as $s)
                            @if(starts_with($s, 'disable_widget_'))
                                <li class="list-group-item">
                                    <div class="pull-right">
                                        @if( Auth::user()->settings->getAttributeValue($s) == 0 )
                                            <a href="{{ action('UserSettingsController@change_setting', [$s, 1])  }}"><span
                                                        class="fa fa-plus-square"></span></a>
                                        @else
                                            <a href="{{ action('UserSettingsController@change_setting', [$s, 0])  }}"><span
                                                        class="fa fa-minus-square"></span></a>
                                        @endif
                                    </div>
                                    {{ trans('app.widget.'.$s) }}
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mb-3">
                {!! Form::open(['action' => ['UserSettingsController@store_rowsPerPage']]) !!}
                <div class="card">
                    <div class="card-header">
                        {{ trans('app.rows_per_page') }}
                    </div>
                    <div class="card-body">
                        @if (count($errors) > 0)
                            <div class="rmarchivtbl errorbox">
                                <h2>{{ trans('app.rows_per_page') }}</h2>
                                <div class="content">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li><strong>{{ $error }}</strong></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="row_dev">{{ trans('app.devs_per_row') }}</label>
                            <select name="row_dev" id="row_dev" class="form-control">
                                @foreach([1, 5, 10, 15, 20, 25, 50, 100, 9999] as $rows)
                                    @if(Auth::user()->settings->rows_per_page_developer == $rows)
                                        <option selected="selected" value="{{ $rows }}">{{ $rows  }}</option>
                                    @else
                                        <option value="{{ $rows }}">{{ $rows }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="row_games">{{ trans('app.games_per_row') }}</label>
                            <select name="row_games" id="row_games" class="form-control">
                                @foreach([1, 5, 10, 15, 20, 25, 50, 100, 9999] as $rows)
                                    @if(Auth::user()->settings->rows_per_page_games == $rows)
                                        <option selected="selected" value="{{ $rows }}">{{ $rows }}</option>
                                    @else
                                        <option value="{{ $rows }}">{{ $rows }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="pull-right">
                            <input class="btn btn-primary" type="submit" id="submit" value="{{ trans('app.submit') }}">
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mb-3">
                {!! Form::open(['action' => ['UserSettingsController@store_password']]) !!}
                <div class="card">
                    <div class="card-header">
                        {{ trans('app.change_password') }}
                    </div>
                    <div class="card-body">
                        @if (count($errors) > 0)
                            <div class="rmarchivtbl errorbox">
                                <h2>{{ trans('app.change_password') }}</h2>
                                <div class="content">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li><strong>{{ $error }}</strong></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="passwordold">{{ trans('app.old_password') }} *</label>
                            <input name="passwordold" id="passwordold" type="password" value=""/>
                        </div>
                        <div class="form-group">
                            <label for="password1">{{ trans('app.new_password') }} *</label>
                            <input name="password1" id="password1" type="password" value=""/>
                        </div>
                        <div class="form-group">
                            <label for="password2">{{ trans('app.new_password_confirm') }} *</label>
                            <input name="password2" id="password2" type="password" value=""/>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="pull-right">
                            <input class="btn btn-primary" type="submit" id="submit" value="{{ trans('app.submit') }}">
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mb-3">
                {!! Form::open(['action' => ['UserSettingsController@change_username']]) !!}
                <div class="card">
                    <div class="card-header">
                        {{ trans('app.change_username') }}
                    </div>
                    <div class="card-body">
                        @if (count($errors) > 0)
                            <div class="rmarchivtbl errorbox">
                                <h2>{{ trans('app.change_username') }}</h2>
                                <div class="content">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li><strong>{{ $error }}</strong></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="usernameold">{{ trans('app.old_username') }} *</label>
                            <input name="usernameold" id="usernameold" type="text" value=""/>
                        </div>
                        <div class="form-group">
                            <label for="usernamenew">{{ trans('app.new_username') }} *</label>
                            <input name="usernamenew" id="usernamenew" type="text" value=""/>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="pull-right">
                            <input class="btn btn-primary" type="submit" id="submit" value="{{ trans('app.submit') }}">
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection