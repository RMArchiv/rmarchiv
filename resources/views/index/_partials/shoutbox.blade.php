<div class="row mt-4">
    <div class="col-md-12">
        <ul class='list-group'>
            <li class="list-group-item active clearfix">{{ trans('app.shoutbox_widget_title') }}</li>
            @foreach($shoutbox as $shout)
                <li class="list-group-item clearfix">
                    <a href='{{ url('users' , $shout->user->id) }}' class='usera' title="{{ $shout->user->name }}">
                        <img width="16px" src='//{{ config('app.avatar_path') }}?gender=male&id={{ $shout->user->id  }}' alt="{{ $shout->user->name }}" class='avatar' /> {{ $shout->user->name }}
                    </a> :: <time datetime='{{ $shout->created_at }}' title='{{ $shout->created_at }}'>{{ \Carbon\Carbon::parse($shout->created_at)->diffForHumans() }}</time>
                    {!! \App\Helpers\InlineBoxHelper::TextColor($shout->shout_html) !!}
                </li>
            @endforeach
            <li class="list-group-item active clearfix">
                @permission(('create-shoutbox'))
                <form method="POST" action="{{ action('ShoutboxController@store') }}">
                    @csrf
                <div class="col-md-12">
                    <div class="input-group">
                        <input class="form-control form-control-sm" type='text' name='shout' placeholder='{{ trans('app.shoutbox_placeholder') }}' id='onelinermsg' maxlength='300'/>
                        <button class="btn btn-outline-secondary btn-sm" type="submit">go!</button>
                        <a href="{{ action('ShoutboxController@index') }}" class="btn link-warning btn-sm" role="button">{{ trans('app.more') }}...</a>
                    </div>
                </div>
                </form>
                @else
                    <div class='foot'><a href='{{ url('shoutbox') }}'>{{ trans('app.more') }}</a>...</div>
                    @endpermission
            </li>
        </ul>
    </div>
</div>