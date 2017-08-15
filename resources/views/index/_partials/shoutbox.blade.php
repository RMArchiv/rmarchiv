<div class="row">
    <div class="col-md-12">
        <ul class='list-group'>
            <li class="list-group-item active clearfix">{{ trans('app.shoutbox_widget_title') }}</li>
            @foreach($shoutbox as $shout)
                <li class="list-group-item clearfix">
                    <a href='{{ url('users' , $shout->user->id) }}' class='usera' title="{{ $shout->user->name }}">
                        <img width="16px" src='//{{ config('avatar_path') }}?gender=male&id={{ $shout->user->id  }}' alt="{{ $shout->user->name }}" class='avatar' /> {{ $shout->user->name }}
                    </a> :: <time datetime='{{ $shout->created_at }}' title='{{ $shout->created_at }}'>{{ \Carbon\Carbon::parse($shout->created_at)->diffForHumans() }}</time>
                    {!! $shout->shout_html !!}
                </li>
            @endforeach
            <li class="list-group-item active clearfix">
                @permission(('create-shoutbox'))
                {!! Form::open(['action' => ['ShoutboxController@store']]) !!}
                <div class="col-md-12">
                    <div class="input-group">
                        <input class="form-control" type='text' name='shout' placeholder='{{ trans('app.shoutbox_placeholder') }}' id='onelinermsg' maxlength='300'/>
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit">go!</button>
                            <a href="{{ action('ShoutboxController@index') }}" class="btn btn-default" role="button">{{ trans('app.more') }}...</a>
                        </span>
                    </div>
                </div>
                {!! Form::close() !!}
                @else
                    <div class='foot'><a href='{{ url('shoutbox') }}'>{{ trans('app.more') }}</a>...</div>
                    @endpermission
            </li>
        </ul>
    </div>
</div>