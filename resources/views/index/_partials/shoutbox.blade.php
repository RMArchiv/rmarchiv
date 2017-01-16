<div class='rmarchivtbl' id='rmarchivbox_latestoneliner'>
    <h2>echte oldschool shoutbox</h2>
    <ul class='boxlist'>
        @foreach($shoutbox as $shout)
        <li>
            <a href='{{ url('users' , $shout->user->id) }}' class='usera' title="{{ $shout->user->name }}">
                <img src='http://ava.rmarchiv.de/?gender=male&id={{ $shout->user->id  }}' alt="{{ $shout->user->name }}" class='avatar' /> {{ $shout->user->name }}
            </a> :: <time datetime='{{ $shout->created_at }}' title='{{ $shout->created_at }}'>{{ \Carbon\Carbon::parse($shout->created_at)->diffForHumans() }}</time>
            {!! $shout->shout_html !!}
        </li>
        @endforeach
    </ul>
    @permission(('create-shoutbox'))
    <div class='foot loggedin'>
        <span><a href='{{ url('shoutbox') }}'>more</a>...</span>
        {!! Form::open(['action' => ['ShoutboxController@store']]) !!}
            <input type='text' name='shout' placeholder='sags mit worten. in einem satz. (300 zeichen max.)' id='onelinermsg' maxlength='300'/>
            <input type='submit' value='Submit'/>
        {!! Form::close() !!}
    </div>
    @else
    <div class='foot'><a href='{{ url('shoutbox') }}'>more</a>...</div>
    @endpermission
</div>