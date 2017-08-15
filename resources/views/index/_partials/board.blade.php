<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">{{ trans('app.10_newest_board_posts') }}</div>
            <table class='table table-stripped table-hover'>
                @foreach($threads as $t)
                    <tr
                            @if(\App\Helpers\DatabaseHelper::isThreadUnread($t->id) === true) style="font-weight: bold;" @endif>
                        <td>
                            <a href='{{ url('users', $t->user->id) }}' class='usera' title="{{ $t->user->name }}">
                                <img width="16px" src='//{{ config('avatar_path') }}?gender=male&id={{ $t->user->id }}'
                                     alt="{{ $t->user->name }}" class='avatar'/>
                            </a>
                            <a href='{{ url('users', $t->user->id) }}' class='usera'
                               title="{{ $t->user->name }}">{{ $t->user->name }}</a>
                        </td>
                        <td class='category'><a
                                    href="{{ route('board.cat.show', $t->cat->id) }}">{{ $t->cat->title }}</a></td>
                        <td>
                            <a href='{{ route('board.thread.show', $t->id) }}'>
                                @if($t->closed == 1)
                                    <img src="/assets/lock.png">
                                @endif
                                @if(\App\Models\BoardPoll::whereThreadId($t->id)->count() != 0)
                                    <img src="/assets/stats.gif">
                                @endif
                                {{ $t->title }}</a>
                        </td>
                        <td class='count' title=''>{{ $t->posts->count()  }}</td>
                        <td>
                            <a href='{{ url('users', $t->last_user->id) }}' class='usera'
                               title="{{ $t->last_user->name }}">
                                <img width="16px" src='//{{ config('avatar_path') }}?gender=&id={{ $t->last_user->id }}'
                                     alt="{{ $t->last_user->name }}" class='avatar'/>
                            </a>
                            <a href='{{ url('users', $t->last_user->id) }}' class='usera'
                               title="{{ $t->last_user->name }}">{{ $t->last_user->name }}</a>
                        </td>
                    </tr>
                @endforeach
            </table>
            <div class='panel-footer'><a href='{{ route('board.show') }}'>{{ trans('app.more') }}</a>...</div>
        </div>
    </div>
</div>