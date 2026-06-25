@extends('layouts.app')
@section('pagetitle', $posts->first()->thread->title)
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    @if($errors->moveThread->any())
                        <div class="alert alert-warning">
                            @foreach($errors->moveThread->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif
                    <div class='btn-toolbar float-end'>
                        <div class='btn-group'>
                            @if(Auth::check())
                                @if(Auth::id() == $posts->first()->thread->user_id or Auth::user()->can('mod-threads'))
                                    @if(!$poll)
                                        <a role="button" class="btn btn-primary" href="{{ route('board.vote.create', ['threadid' => $posts->first()->thread_id])}}"><span class="fa fa-signal fa-rotate-270"></span></a>
                                    @endif
                                @endif
                            @endif
                            @permission(('mod-threads'))
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#moveThreadModal" title="{{ trans('app.move_thread') }}" aria-label="{{ trans('app.move_thread') }}">
                                <span class="fa fa-share"></span>
                            </button>
                            @if($posts->first()->thread->closed == 0)
                                <a role="button" class="btn btn-primary" href="{{ route('board.thread.switch.close', [$posts->first()->thread->id, 1]) }}"><span class="fa fa-minus-circle"></span></a>
                            @else
                                <a role="button" class="btn btn-primary" href="{{ route('board.thread.switch.close', [$posts->first()->thread->id, 0]) }}"><span class="fa fa-plus-circle"></span></a>
                            @endif
                            @endpermission
                        </div>
                    </div>

                    <h1>{{$posts->first()->thread->title}}</h1>
                    {!! Breadcrumbs::render('thread',$posts->first()->cat, $posts->first()->thread ) !!}
                </div>
            </div>
        </div>
        @permission(('mod-threads'))
        <div class="modal fade" id="moveThreadModal" tabindex="-1" aria-labelledby="moveThreadModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST" action="{{ route('board.thread.move', $posts->first()->thread->id) }}">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="moveThreadModalLabel">{{ trans('app.move_thread') }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ trans('app.close') }}"></button>
                        </div>
                        <div class="modal-body">
                            <label for="new_cat_id" class="form-label">{{ trans('app.choose_target_forum') }}</label>
                            <select name="new_cat_id" id="new_cat_id" class="form-select" required>
                                @foreach($moveCategories as $moveCategory)
                                    @if($moveCategory->id != $posts->first()->thread->cat_id)
                                        <option value="{{ $moveCategory->id }}" @if((int) old('new_cat_id') === (int) $moveCategory->id) selected @endif>
                                            {{ $moveCategory->title }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ trans('app.cancel') }}</button>
                            <button type="submit" class="btn btn-primary">{{ trans('app.move_thread') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endpermission
        @if($poll)
        <div class="row">
            <div class="col-md-12 mb-3">
                <div class="card">
                    <div class="card-header">
                        {{ $poll->title }}
                    </div>
                    <div class="card-body">
                        @foreach($answers as $ans)
                            @if($ans->title != '')
                                <form method="POST" action="{{ action('BoardController@add_vote') }}" id="{{'vote_'.$ans->id}}">
                                    @csrf
                                <input type="hidden" name="poll_id" value="{{ $poll->id }}">
                                <input type="hidden" name="answer_id" value="{{ $ans->id }}">
                                <input type="hidden" name="thread_id" value="{{ $posts->first()->thread_id }}">
                                <strong>
                                    @if($votes)
                                        @if($votes->count() != 0 and $votes->first()->answer_id == $ans->id)
                                            <span class="text-muted">{{ $ans->title }}</span>
                                        @else
                                            <a href="javascript:{}" onclick="document.getElementById('vote_{{$ans->id}}').submit(); return false;">{{ $ans->title }}</a>
                                        @endif
                                    @else
                                        {{ $ans->title }}
                                    @endif
                                </strong>
                                <span class="float-end">{{  round(\App\Helpers\MiscHelper::getPopularity($ans->votes->count(), $votecount)) }}%</span>
                                <div class="progress progress-danger">
                                    <div class="progress-bar" style="width: {{ \App\Helpers\MiscHelper::getPopularity($ans->votes->count(), $votecount) }}%;"></div>
                                </div>
                                </form>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @endif
        <div class="row">
            <div class="col-md-12 mb-3">
                <div class="card">
                    <div class="card-header">{{ $posts->links('vendor.pagination.bootstrap-4') }}</div>
                    <div class="card-body">
                        <ul class="list-unstyled mb-0">
                            @foreach($posts as $post)
                                @php
                                    $user = $post->user;
                                    $stats = $postUserStats->get($user->id, [
                                        'board_posts' => 0,
                                        'games' => 0,
                                        'gamefiles' => 0,
                                        'developers' => 0,
                                        'shoutbox_posts' => 0,
                                    ]);
                                    $memberSince = \Carbon\Carbon::parse($user->created_at);
                                    $years = (int) $memberSince->diffInYears();
                                    $months = (int) $memberSince->diffInMonths();
                                    $weeks = (int) $memberSince->diffInWeeks();
                                    $days = max(1, (int) $memberSince->diffInDays());

                                    if ($years >= 1) {
                                        $membership = $years.' '.($years === 1 ? 'Jahr' : 'Jahre');
                                    } elseif ($months >= 1) {
                                        $membership = $months.' '.($months === 1 ? 'Monat' : 'Monate');
                                    } elseif ($weeks >= 1) {
                                        $membership = $weeks.' '.($weeks === 1 ? 'Woche' : 'Wochen');
                                    } else {
                                        $membership = $days.' '.($days === 1 ? 'Tag' : 'Tage');
                                    }
                                @endphp
                                <li id="c{{$post->id}}" class="mb-3">
                                    <article class="card">
                                        <div class="row g-0">
                                            <aside class="col-md-3 col-lg-2 border-end" style="border-color: var(--bs-card-border-color) !important;">
                                                <div class="card-body text-center">
                                                    <a href="{{ action('UserController@show', $user->id) }}" class="user fw-bold d-block mb-2">{{ $user->name }}</a>
                                                    <a href="{{ action('UserController@show', $user->id) }}">
                                                        <img class="img-fluid rounded mb-2" style="max-width: 120px;" src="//{{ config('app.avatar_path') }}?size=160&gender=male&id={{ $user->id }}" alt="{{ $user->name }}">
                                                    </a>
                                                    <div class="small text-muted mb-4">
                                                        {{ $user->roles->first()?->display_name ?? '-' }}
                                                    </div>

                                                    <dl class="small text-start mb-4">
                                                        <div class="d-flex justify-content-between gap-2">
                                                            <dt>Beiträge</dt>
                                                            <dd class="mb-1">{{ number_format($stats['board_posts'], 0, ',', '.') }}</dd>
                                                        </div>
                                                        <div class="d-flex justify-content-between gap-2">
                                                            <dt>Spiele</dt>
                                                            <dd class="mb-1">{{ number_format($stats['games'], 0, ',', '.') }}</dd>
                                                        </div>
                                                        <div class="d-flex justify-content-between gap-2">
                                                            <dt>Gamefiles</dt>
                                                            <dd class="mb-1">{{ number_format($stats['gamefiles'], 0, ',', '.') }}</dd>
                                                        </div>
                                                        <div class="d-flex justify-content-between gap-2">
                                                            <dt>Entwickler</dt>
                                                            <dd class="mb-1">{{ number_format($stats['developers'], 0, ',', '.') }}</dd>
                                                        </div>
                                                        <div class="d-flex justify-content-between gap-2">
                                                            <dt>Shoutbox</dt>
                                                            <dd class="mb-1">{{ number_format($stats['shoutbox_posts'], 0, ',', '.') }}</dd>
                                                        </div>
                                                    </dl>

                                                    <div class="small text-muted">
                                                        Mitgliedschaft: {{ $membership }}
                                                    </div>
                                                </div>
                                            </aside>
                                            <div class="col-md-9 col-lg-10">
                                                <div class="card-body">
                                                    <div class="mb-3">
                                                        <small class="text-muted">
                                                            <a href='{{ route('board.thread.show', [$post->thread->id]) }}#c{{ $post->id }}' class="text-muted">
                                                                <time datetime='{{ $post->created_at }}' title='{{ $post->created_at }}'>{{ \Carbon\Carbon::parse($post->created_at)->format('d.m.Y H:i') }}</time>
                                                            </a>
                                                            @if($post->updated_at && \Carbon\Carbon::parse($post->updated_at)->gt(\Carbon\Carbon::parse($post->created_at)))
                                                                <span> • </span>{{ trans('app.edited_at') }} {{ \Carbon\Carbon::parse($post->updated_at)->diffForHumans() }}
                                                            @endif
                                                        </small>
                                                    </div>
                                                    <div class="board-post-content">
                                                        {!! \App\Helpers\InlineBoxHelper::GameBox($post->content_html) !!}
                                                    </div>
                                                    @if(Auth::check())
                                                        <div class="d-flex justify-content-end gap-2 mt-4">
                                                            @include('reports._partials.report-button', [
                                                                'reportType' => 'board_post',
                                                                'reportId' => $post->id,
                                                                'reportLabel' => $posts->first()->thread->title,
                                                            ])
                                                            @if(Auth::id() == $user->id or Auth::user()->can('mod-threads'))
                                                                <a class="btn btn-sm btn-outline-secondary" href="{{ route('board.post.edit', [$post->thread->id, $post->id]) }}" data-rel="popup">{{ trans('app.edit') }}</a>
                                                            @endif
                                                            @if($post->thread->closed == 0)
                                                                <button
                                                                    type="button"
                                                                    class="btn btn-sm btn-outline-primary quote-post-button"
                                                                    data-quote-user="{{ $user->name }}"
                                                                    data-quote-content="{{ base64_encode($post->content_md ?? strip_tags($post->content_html)) }}"
                                                                >
                                                                    Antworten
                                                                </button>
                                                            @endif
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="card-footer">{{ $posts->links('vendor.pagination.bootstrap-4') }}</div>
                </div>
            </div>
        </div>
        @if(Auth::check())
            <script>
                window.addEventListener('load', function () {
                    function decodeQuoteContent(encoded) {
                        const bytes = Uint8Array.from(atob(encoded), function (character) {
                            return character.charCodeAt(0);
                        });

                        return new TextDecoder().decode(bytes);
                    }

                    function escapeHtml(value) {
                        return value
                            .replace(/&/g, '&amp;')
                            .replace(/</g, '&lt;')
                            .replace(/>/g, '&gt;')
                            .replace(/"/g, '&quot;')
                            .replace(/'/g, '&#039;');
                    }

                    function createQuote(user, content) {
                        const normalizedContent = content.replace(/\r\n/g, '\n').replace(/\r/g, '\n');
                        const quotedLines = normalizedContent
                            .replace(/\r\n/g, '\n')
                            .replace(/\r/g, '\n')
                            .split('\n')
                            .map(function (line) {
                                return '> ' + line;
                            })
                            .join('\n');

                        return {
                            markdown: '> **' + user + ' schrieb:**\n' + quotedLines + '\n\n',
                            html: '<blockquote><p><strong>' + escapeHtml(user) + ' schrieb:</strong></p><p>' + escapeHtml(normalizedContent).replace(/\n/g, '<br>') + '</p></blockquote><p>&nbsp;</p>'
                        };
                    }

                    document.querySelectorAll('.quote-post-button').forEach(function (button) {
                        button.addEventListener('click', function () {
                            const quote = createQuote(
                                button.dataset.quoteUser,
                                decodeQuoteContent(button.dataset.quoteContent)
                            );
                            const textarea = document.getElementById('msg');
                            const editor = window.rmarchivEditors && window.rmarchivEditors.msg;
                            const currentValue = editor ? editor.getData() : (textarea ? textarea.value : '');
                            const fallbackValue = textarea ? textarea.value : '';

                            if (editor) {
                                editor.setData((currentValue.trim() !== '' ? currentValue + '<p>&nbsp;</p>' : '') + quote.html);
                            }

                            if (textarea) {
                                textarea.value = (fallbackValue.trim() !== '' ? fallbackValue + '\n\n' : '') + quote.markdown;
                                textarea.closest('form').scrollIntoView({behavior: 'smooth', block: 'start'});
                            }
                        });
                    });
                });
            </script>
        @endif
        <div class="row">
            <div class="col-md-12 mb-3">
                @if(Auth::check())
                    <div class="card">
                        <div class="card-header">
                            {{ trans('app.create_thread') }}
                        </div>
                        <div class="card-body">
                            @if($post->thread->closed == 0)
                                <form method="POST" action="{{ action('BoardController@store_post', $posts->first()->thread->id) }}">
                                    @csrf
                                <input type='hidden' name='catid' value='{{ $posts->first()->cat->id }}'>
                                <div class='content'>
                                    @include('_partials.markdown_editor')
                                    <div><a href='#'>{{ trans('app.markdown_is_usable_here') }}</a></div>
                                </div>
                                <div class='foot'>
                                    <button class="btn btn-primary" id='submit'>{{ trans('app.submit') }}</button>
                                </div>
                                </form>
                            @else
                                <h2>{{ trans('app.thread_is_closed') }}</h2>
                                {{ trans('app.thread_is_closed_you_cant_post') }}
                            @endif
                        </div>
                    </div>
                @else
                    <div class="card">
                        <div class="card-header">
                            {{ trans('app.login_needed_to_post') }}
                        </div>
                        <div class="card-body">
                            {{ trans('app.login_needed_to_post') }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
