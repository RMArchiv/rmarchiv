@extends('layouts.app')
@section('pagetitle', trans('app.user_settings'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="page-header">
                <h1>{{ trans('app.user_settings') }}</h1>
                {!! Breadcrumbs::render('impressum') !!}
            </div>
        </div>
        <div class="row">
            <form action="//{{ config('app.avatar_path') }}/upload.php" method="post" enctype="multipart/form-data">
                <div class="panel panel-default">
                    <input type="hidden" name="posttype" value="avatar">
                    <input type="hidden" name="userid" value="{{ Auth::id() }}">
                    <div class="panel-heading">
                        {{ trans('app.avatar_upload') }}
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="file">{{ trans('app.upload_file') }}</label>
                            <input type="file" id="file" name="file">
                            <p class="help-block">160*160px MAX! (gif,png,jpg)</p>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <div class="pull-right">
                            <input class="btn btn-primary" type="submit" id="submit" value="{{ trans('app.submit') }}">
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </form>
        </div>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('app.indexpage_widget_settings') }}
                </div>
                <ul class="list-group">
                    @foreach(Schema::getColumnListing('user_settings') as $s)
                        @if(starts_with($s, 'disable_widget_'))
                            <li class="list-group-item">
                                <div class="pull-right">
                                    @if( Auth::user()->settings->getAttributeValue($s) == 0 )
                                        <a href="{{ action('UserSettingsController@change_setting', [$s, 1])  }}"><span class="fa fa-plus-square"></span></a>
                                    @else
                                        <a href="{{ action('UserSettingsController@change_setting', [$s, 0])  }}"><span class="fa fa-minus-square"></span></a>
                                    @endif
                                </div>
                                {{ trans('app.widget.'.$s) }}
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="row">
            {!! Form::open(['action' => ['UserSettingsController@store_rowsPerPage']]) !!}
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('app.rows_per_page') }}
                </div>
                <div class="panel-body">
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
                <div class="panel-footer">
                    <div class="pull-right">
                        <input class="btn btn-primary" type="submit" id="submit" value="{{ trans('app.submit') }}">
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
        <div class="row">
            {!! Form::open(['action' => ['UserSettingsController@store_password']]) !!}
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('app.change_password') }}
                </div>
                <div class="panel-body">
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
                <div class="panel-footer">
                    <div class="pull-right">
                        <input class="btn btn-primary" type="submit" id="submit" value="{{ trans('app.submit') }}">
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
        <div class="row">
            {!! Form::open(['action' => ['UserSettingsController@change_username']]) !!}
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('app.change_username') }}
                </div>
                <div class="panel-body">
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
                <div class="panel-footer">
                    <div class="pull-right">
                        <input class="btn btn-primary" type="submit" id="submit" value="{{ trans('app.submit') }}">
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>

@endsection