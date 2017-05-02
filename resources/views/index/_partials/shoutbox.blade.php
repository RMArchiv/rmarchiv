<div class="row">
    <ul class='list-group'>
        <li class="list-group-item active">{{ trans('index.shoutbox.title') }}</li>
        @foreach($shoutbox as $shout)
            <li class="list-group-item">
                <a href='{{ url('users' , $shout->user->id) }}' class='usera' title="{{ $shout->user->name }}">
                    <img width="16px" src='http://ava.rmarchiv.de/?gender=male&id={{ $shout->user->id  }}' alt="{{ $shout->user->name }}" class='avatar' /> {{ $shout->user->name }}
                </a> :: <time datetime='{{ $shout->created_at }}' title='{{ $shout->created_at }}'>{{ \Carbon\Carbon::parse($shout->created_at)->diffForHumans() }}</time>
                {!! $shout->shout_html !!}
            </li>
        @endforeach
        <li class="list-group-item active">
            @permission(('create-shoutbox'))
            <div class='foot loggedin'>
                <span><a href='{{ url('shoutbox') }}'>{{ trans('index.shoutbox.more') }}</a>...</span>
                {!! Form::open(['action' => ['ShoutboxController@store']]) !!}
                <input type='text' name='shout' placeholder='{{ trans('index.shoutbox.placeholder') }}' id='onelinermsg' maxlength='300'/>
                <input type='submit' value='Submit'/>
                {!! Form::close() !!}
            </div>
            @else
                <div class='foot'><a href='{{ url('shoutbox') }}'>{{ trans('index.shoutbox.more') }}</a>...</div>
                @endpermission
        </li>
    </ul>
</div>