<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">{{ trans('index.stats.title') }}</div>
                <table class="table table-striped table-hover">
                    <tr>
                        <td>
                            {{ number_format($stats->gamecount, 0, ',', '.') }} <a href='{{ url('games') }}'>{{ trans('index.stats.games') }}</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{ number_format($stats->makercount, 0, ',', '.') }} {{ trans('index.stats.maker') }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{ number_format($stats->developercount, 0, ',', '.') }} <a href="{{ url('developer') }}">{{ trans('index.stats.developer') }}</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{ number_format($stats->usercount, 0, ',', '.') }} <a href='{{ url('users') }}'>{{ trans('index.stats.user') }}</a> - <a href="{{ url('users/activity') }}">{{ trans('index.stats.activity') }}</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            neuester user: <a href="{{ action('UserController@show', $newuser->id) }}">{{ $newuser->name }}</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{ number_format($stats->logocount, 0, ',', '.') }} <a href='{{ url('logo/vote') }}'>{{ trans('index.stats.logos') }}</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{ number_format($stats->threadcount, 0, ',', '.') }} <a href='{{ url('board') }}'>{{ trans('index.stats.board_threads') }}</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{ number_format($stats->postcount, 0, ',', '.') }} <a href='{{ url('board') }}'>{{ trans('index.stats.board_posts') }}</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{ number_format($stats->shoutboxcount, 0, ',', '.') }} <a href='{{ url('shoutbox') }}'>{{ trans('index.stats.shouts') }}</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{ number_format($stats->commentcount, 0, ',', '.') }} {{ trans('index.stats.comments') }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{ number_format($stats->filecount, 0, ',', '.') }} {{ trans('index.stats.gamefiles') }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{ \App\Helpers\MiscHelper::getReadableBytes($stats->totalsize) }} {{ trans('index.stats.gamefiles_size') }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{ number_format($stats->downloadcount, 0, ',', '.') }} {{ trans('index.stats.gamefiles_download') }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{ $size }} {{ trans('index.stats.gamefiles_downloadtraffic') }}
                        </td>
                    </tr>
                </table>
            <div class="panel-footer">
                <a href="{{ url('stats') }}">{{ trans('index.shoutbox.more') }}</a>
            </div>
        </div>
    </div>
</div>
