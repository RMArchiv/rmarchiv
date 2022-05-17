<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">{{ trans('app.statistics') }}</div>
                <table class="table table-striped table-hover">
                    <tr>
                        <td>
                            {{ number_format($stats_gamecount, 0, ',', '.') }}
                            <a href='{{ url('games') }}'>{{ trans('app.games') }}</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{ number_format($stats_makercount, 0, ',', '.') }} {{ trans('app.makers') }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{ number_format($stats_developercount, 0, ',', '.') }}
                            <a href="{{ url('developer') }}">{{ trans('app.developers') }}</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{ number_format($stats_usercount, 0, ',', '.') }}
                            <a href='{{ url('users') }}'>{{ trans('app.users') }}</a> -
                            <a href="{{ url('users/activity') }}">{{ trans('app.user_activities') }}</a>
                        </td>
                    </tr>
                    @if($newuser)
                        <tr>
                            <td>
                                {{ trans('app.newest_user') }}:
                                <a href="{{ action('UserController@show', $newuser->id) }}">{{ $newuser->name }}</a>
                            </td>
                        </tr>
                    @endif
                    <tr>
                        <td>
                            {{ number_format($stats_logocount, 0, ',', '.') }}
                            <a href='{{ url('logo/vote') }}'>{{ trans('app.logos') }}</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{ number_format($stats_threadcount, 0, ',', '.') }}
                            <a href='{{ url('board') }}'>{{ trans('app.board_threads') }}</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{ number_format($stats_postcount, 0, ',', '.') }}
                            <a href='{{ url('board') }}'>{{ trans('app.board_posts') }}</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{ number_format($stats_shoutboxcount, 0, ',', '.') }}
                            <a href='{{ url('shoutbox') }}'>{{ trans('app.shouts') }}</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{ number_format($stats_commentcount, 0, ',', '.') }} {{ trans('app.comments') }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{ number_format($stats_filecount, 0, ',', '.') }} {{ trans('app.gamefiles') }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{ \App\Helpers\MiscHelper::getReadableBytes($stats_totalsize) }} {{ trans('app.gamefiles_total_size') }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{ number_format($stats_downloadcount, 0, ',', '.') }} {{ trans('app.games_downloaded') }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{ $size }} {{ trans('app.download_traffic') }}
                        </td>
                    </tr>
                </table>
            <div class="card-footer">
                <a href="{{ url('stats') }}">{{ trans('app.more') }}...</a>
            </div>
        </div>
    </div>
</div>
