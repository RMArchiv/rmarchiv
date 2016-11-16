<div class='rmarchivtbl' id='rmarchivbox_latestoneliner'>
    <h2>echte oldschool shoutbox</h2>
    <ul class='boxlist'>
        @foreach($shoutbox as $shout)
        <li>
            <a href='{{ url('users' , $shout->userid) }}' class='usera' title="{{ $shout->username }}">
                <img src='http://ava.rmarchiv.de/?gender=male&id={{ $shout->userid  }}' alt="{{ $shout->username }}" class='avatar' /> {{ $shout->username }}
            </a> :: <time datetime='{{ $shout->shoutcreated_at }}' title='{{ $shout->shoutcreated_at }}'>{{ $shout->shoutcreated_at }}</time>
            {!! $shout->shouthtml !!}
        </li>
        @endforeach
    </ul>
    @if(Auth::check())
    <div class='foot loggedin'>
        <span><a href='{{ url('shoutbox') }}'>mehr</a>...</span>
        {!! Form::open(['action' => ['ShoutboxController@store']]) !!}
            <input type='text' name='shout' placeholder='sags mit worten. in einem satz. (300 zeichen max.)' id='onelinermsg' maxlength='300'/>
            <input type='submit' value='Submit'/>
        {!! Form::close() !!}
    </div>
    @else
    <div class='foot'><a href='{{ url('shoutbox') }}'>mehr</a>...</div>
    @endif
</div>