<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">{{ trans('app.statistics') }}</div>
                <table class="table table-striped table-hover">
                    <tr>
                        <td>
                            {{ number_format($stats->gamecount, 0, ',', '.') }}
                            <a href='{{ url('games') }}'>{{ trans('app.games') }}</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{ number_format($stats->makercount, 0, ',', '.') }} {{ trans('app.makers') }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{ number_format($stats->developercount, 0, ',', '.') }}
                            <a href="{{ url('developer') }}">{{ trans('app.developers') }}</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{ number_format($stats->usercount, 0, ',', '.') }}
                            <a href='{{ url('users') }}'>{{ trans('app.users') }}</a> -
                            <a href="{{ url('users/activity') }}">{{ trans('app.user_activities') }}</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{ trans('app.newest_user') }}:
                            <a href="{{ action('UserController@show', $newuser->id) }}">{{ $newuser->name }}</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{ number_format($stats->logocount, 0, ',', '.') }}
                            <a href='{{ url('logo/vote') }}'>{{ trans('app.logos') }}</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{ number_format($stats->threadcount, 0, ',', '.') }}
                            <a href='{{ url('board') }}'>{{ trans('app.board_threads') }}</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{ number_format($stats->postcount, 0, ',', '.') }}
                            <a href='{{ url('board') }}'>{{ trans('app.board_posts') }}</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{ number_format($stats->shoutboxcount, 0, ',', '.') }}
                            <a href='{{ url('shoutbox') }}'>{{ trans('app.shouts') }}</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{ number_format($stats->commentcount, 0, ',', '.') }} {{ trans('app.comments') }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{ number_format($stats->filecount, 0, ',', '.') }} {{ trans('app.gamefiles') }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{ \App\Helpers\MiscHelper::getReadableBytes($stats->totalsize) }} {{ trans('app.gamefiles_total_size') }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{ number_format($stats->downloadcount, 0, ',', '.') }} {{ trans('app.games_downloaded') }}
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
