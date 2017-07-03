@extends('layouts.app')
@section('pagetitle', 'event: '.$event->title)
@section('content')
    <div id="content">
        @if(count($event) > 0)
            <div id="prodpagecontainer">
                <div class="rmarchivtbl rmarchivbox_newsbox" id="rmarchivbox_prodmain">
                    <h2>
                        {{ $event->title }}
                    </h2>
                    <div class="content">
                        <table id='rmarchiv_prodlist' class='boxtable pagedtable'>
                            <tr>
                                <td width="50%">
                                    {!! Markdown::convertToHtml($event->description) !!}
                                </td>
                                <td>
                                    <table>
                                        <tr>
                                            <td>
                                                Slots: {{ $event->users_registered->count() }}/{{ $event->settings->slots }}
                                                @if($event->settings->reg_allowed == 1 && $event->settings->slots > $event->users_registered->count())
                                                    @if($reg_user->count() == 0)
                                                        [<a href="{{ action('EventController@register', $event->id) }}">anmelden</a>]
                                                    @else
                                                        (du bist angemeldet)
                                                    @endif
                                                @else
                                                    (anmeldung geschlossen)
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>

                    </div>
                    <div class="foot">
                        Event erstellt von <a href='{{ url('users', $event->user_id) }}'>{{ $event->user->name }}</a> :: <time datetime='{{ $event->created_at }}' title='{{ $event->created_at }}'>{{ \Carbon\Carbon::parse($event->created_at)->diffForHumans() }}</time>
                    </div>
                    @if(Auth::check())
                        <div class="foot">
                            @if(Auth::user()->settings->is_admin)
                                <a href="javascript:void(0);" onclick="$(this).find('form').submit();" >
                                    <form action="{{ url('/event', $event->id) }}" method="post">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="DELETE">
                                    </form>
                                    [{{ trans('app.news.show.delete') }}]
                                </a> ::
                            @endif
                            @permission(('edit-news'))
                            :: <a href="{{ action('EventController@edit', $event->id) }}">[edit]</a>
                            @endpermission
                        </div>
                    @endif
                </div>

                <div class='rmarchivtbl' id='rmarchivbox_prodpopularityhelper'>
                    <h2>{{ trans('app.news.popularity_helper.title') }}</h2>
                    <div class='content'>
                        <p>{{ trans('app.news.popularity_helper.msg') }}</p>
                        <input type='text' value='{{ Request::fullUrl() }}' size='50' readonly='readonly' />
                    </div>
                </div>

                @if($event->comments->count() > 0)
                    <div class='rmarchivtbl' id='rmarchivbox_prodcomments'>
                        <h2>kommentare</h2>
                        @foreach($event->comments as $comment)
                            <div class='comment cite-{{ $comment->user_id }}' id='c{{ $comment->id }}'>
                                <div class='content'>
                                    {!! $comment->comment_html !!}
                                </div>
                                <div class='foot'>
                                    @if($comment->vote_up == 1 and $comment->vote_down == 0)
                                        <span class='vote up'>up</span>
                                    @elseif($comment->vote_up == 0 and $comment->vote_down == 1)
                                        <span class='vote down'>down</span>
                                    @endif

                                    <span class='tools' data-cid='{{ $event->id }}'></span> hinzugefügt am {{ $comment->created_at }} von <a href='{{ url('user', $comment->user_id) }}' class='user'>{{ $comment->name }}</a>
                                    <a href='{{ url('users', $comment->user_id) }}' class='usera' title="{{ $comment->name }}"><img src='//ava.rmarchiv.de/?gender=male&id={{ $comment->user_id }}' alt="{{ $comment->name }}" class='avatar' />
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class='rmarchivtbl' id='rmarchivbox_prodcomments'>
                        <h2>kommentare</h2>
                        <div class="comment">
                            <div class="content">
                                Es sind noch keine Kommentare vorhanden.
                            </div>
                        </div>
                    </div>
                @endif

                <div class='rmarchivtbl' id='rmarchivbox_prodsubmitchanges'>
                    <h2>kommentarhinweise</h2>
                    <div class='content'>
                        <p>{{ trans('app.comments.tip1') }}</p>
                        <p>{{ trans('app.comments.tip2') }}</p>
                        <p>{{ trans('app.comments.tip3') }}</p>
                        <p>{{ trans('app.comments.tip4') }}</p>
                    </div>
                </div>

                @if(Auth::check())
                    <div class='rmarchivtbl' id='rmarchivbox_prodpost'>
                        <h2>kommentar hinzufügen</h2>
                        {!! Form::open(['action' => ['CommentController@add']]) !!}
                        {!! Form::hidden('content_id', $event->id) !!}
                        {!! Form::hidden('content_type', 'event') !!}
                        <div class='content'>
                            @if(CheckRateable::checkRateable('news', $event->id, Auth::id()) === true)
                                <div id='prodvote'>
                                    hier wird dieses event bewertet:<br>
                                    dieses event<br>
                                    <input type='radio' name='rating' id='ratingrulez' value='up' />
                                    <label for='ratingrulez'>ist super</label>
                                    <input type='radio' name='rating' id='ratingpig' value='neut' checked='checked' />
                                    <label for='ratingpig'>ist ok</label>
                                    <input type='radio' name='rating' id='ratingsucks' value='down' />
                                    <label for='ratingsucks'>ist scheiße</label>
                                </div>
                            @endif
                            @include('_partials.markdown_editor')
                            <div><a href='/?page=faq#markdown'><b>markown</b></a> kann benutzt werden</div>
                        </div>
                        <div class='foot'>
                            <input type='submit' value='Submit' id='submit'>
                        </div>
                        {!! Form::close() !!}
                    </div>
                @endif
            </div>
        @else
            <h2>zu dieser id existiert keine news</h2>
        @endif
    </div>
@endsection