@extends('layouts.app')
@section('pagetitle', 'profileinstellungen')
@section('content')
    <div id="content">
        <form action="http://ava.rmarchiv.de/upload.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="posttype" value="avatar">
            <input type="hidden" name="userid" value="{{ Auth::id() }}">
            <div class="rmarchivtbl" id="rmarchivbox_changeavatar">
                <h2>avatarupload</h2>
                <div class="content">
                    <div class="formifier">
                        <div class="row" id="row_file">
                            <label for="file">datei wählen:</label>
                            <input name="file" id="file" type="file" value=""/>
                            <span> [<span class="req">req</span>] 16*16px MAX! (gif,png,jpg)</span>
                        </div>
                    </div>
                </div>
                <div class="foot">
                    <input type="submit" id="submit" value="senden">
                </div>
            </div>
        </form>

        <div class="rmarchivtbl" id="rmarchivbox_news">
            <h2>deaktivieren von hauptseiten widgets</h2>
            <div class="content">
                daumen hoch = wird angezeigt.
                <table>
                    @foreach(Schema::getColumnListing('user_settings') as $s)
                        @if(starts_with($s, 'disable_widget_'))
                            <tr>
                                <td>
                                    {{ trans('app.user.settings.'.$s) }}
                                </td>
                                <td>
                                    @if( Auth::user()->settings->getAttributeValue($s) == 0 )
                                        <a href="{{ action('UserSettingsController@change_setting', [$s, 1])  }}"><img src="assets/rate_up.gif"></a>
                                    @else
                                        <a href="{{ action('UserSettingsController@change_setting', [$s, 0])  }}"><img src="assets/rate_down.gif"></a>
                                    @endif
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </table>
            </div>
            <div class="foot">
                <input type="submit" id="submit" value="senden">
            </div>
        </div>

        {!! Form::open(['action' => ['UserSettingsController@store_password']]) !!}
            <div class="rmarchivtbl" id="rmarchivbox_changepassword">
                <h2>passwort ändern</h2>
                @if (count($errors) > 0)
                    <div class="rmarchivtbl errorbox">
                        <h2>passwort ändern</h2>
                        <div class="content">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li><strong>{{ $error }}</strong></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
                <div class="content">
                    <div class="formifier">
                        <div class="row" id="row_passwordold">
                            <label for="passwordold">altes passwort:</label>
                            <input name="passwordold" id="passwordold" type="password" value=""/>
                            <span> [<span class="req">req</span>]</span>
                        </div>
                        <div class="row" id="row_password1">
                            <label for="password1">neues passwort:</label>
                            <input name="password1" id="password1" type="password" value=""/>
                            <span> [<span class="req">req</span>]</span>
                        </div>
                        <div class="row" id="row_password2">
                            <label for="password2">neues passwort wiederholen:</label>
                            <input name="password2" id="password2" type="password" value=""/>
                            <span> [<span class="req">req</span>]</span>
                        </div>
                    </div>
                </div>
                <div class="foot">
                    <input type="submit" id="submit" value="senden">
                </div>
            </div>
        {!! Form::close() !!}
    </div>
@endsection