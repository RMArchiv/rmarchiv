@extends('layouts.app')
@section('content')
    <div class="content">
        @include('awards._partials.nav')
        @if (count($errors) > 0)
            <div class="rmarchivtbl errorbox">
                <h2>auszeichnung anlegen</h2>
                <div class="content">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li><strong>{{ $error }}</strong></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        {!! Form::open(['action' => ['AwardController@store_page']]) !!}
        <div class="rmarchivtbl" id="rmarchivbox_submitprod">
            <h2>auszeichnungswebsite hinzufügen</h2>
            <div class="content">
                <div class="formifier">
                    <div class="row" id="row_awardpage">
                        <label for="awardpage">website:</label>
                        <input autocomplete="off" class="auto" name="awardpage" id="awardpage" placeholder="awardpage" value=""/>
                        <span> [<span class="req">req</span>] <br>wird die seite in den vorschlägen gefunden, <br>dann existiert sie schon.</span>
                    </div>
                    <script type="text/javascript">
                        var sourcepath = new Bloodhound({
                            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
                            queryTokenizer: Bloodhound.tokenizers.whitespace,
                            //prefetch: '../data/films/post_1960.json',
                            remote: {
                                url: '/ac_award_page/%QUERY',
                                wildcard: '%QUERY'
                            }
                        });

                        $('#row_awardpage .auto').typeahead(null, {
                            name: 'awardpage',
                            display: 'value',
                            source: sourcepath,
                            limit: 5,
                            templates: {
                                empty: [
                                    '<div style="color: #00001a;">',
                                    '{{trans('app.misc.nothing_found')}}',
                                    '</div>'
                                ].join('\n'),
                                suggestion: function(data) {
                                    console.log(data);
                                    return '<p><strong>' + data.value + '</strong></p>';
                                }
                            }
                        });
                    </script>
                    <div class="row" id="row_awardpageurl">
                        <label for="awardpageurl">url (mit http):</label>
                        <input name="awardpageurl" id="awardpageurl" placeholder="url" value=""/>
                    </div>
                </div>
            </div>
            <div class="foot">
                <input type="submit" value="{{trans('app.misc.send')}}">
            </div>
        </div>
        {!! Form::close() !!}

        {!! Form::open(['action' => ['AwardController@store_cat']]) !!}
        <div class="rmarchivtbl" id="rmarchivbox_submitprod">
            <h2>auszeichnungsname hinzufügen</h2>
            <div class="content">
                <div class="formifier">
                    <div class="row" id="row_awardpage">
                        <label for="awardpage">{{trans('app.games.gamefiles.release_date2')}}</label>
                        <select name="awardpage" id="awardpage">
                            <option value="0">Bitte auswählen</option>
                            @foreach($pages as $page)
                                <option value="{{ $page->id }}">{{ $page->title }}</option>
                            @endforeach
                        </select>
                        <span>[<span class="req">req</span>]</span>
                    </div>
                    <div class="row" id="row_awardname">
                        <label for="awardname">name:</label>
                        <input autocomplete="off" class="auto" name="awardname" id="awardname" placeholder="awardname" value=""/>
                        <span> [<span class="req">req</span>]</span>
                    </div>
                    <script type="text/javascript">
                        var sourcepath = new Bloodhound({
                            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
                            queryTokenizer: Bloodhound.tokenizers.whitespace,
                            //prefetch: '../data/films/post_1960.json',
                            remote: {
                                url: '/ac_award_cat/%QUERY',
                                wildcard: '%QUERY'
                            }
                        });

                        $('#row_awardname .auto').typeahead(null, {
                            name: 'awardname',
                            display: 'value',
                            source: sourcepath,
                            limit: 5,
                            templates: {
                                empty: [
                                    '<div style="color: #00001a;">',
                                    '{{trans('app.misc.nothing_found')}}',
                                    '</div>'
                                ].join('\n'),
                                suggestion: function(data) {
                                    console.log(data);
                                    return '<p><strong>' + data.value + '</strong></p>';
                                }
                            }
                        });
                    </script>
                    <div class="row" id="row_awarddate">
                        <label for="awarddate">{{trans('app.games.gamefiles.release_date2')}}</label>
                        <div class="formdate" id="awarddate">
                            <select name="awarddate_month" id="awarddate_month">
                                <option value="0">{{trans('app.games.gamefiles.month')}}</option>
                                @for($i = 1; $i < 13; $i++)
                                    <option value="{{ $i }}">{{ trans('app.misc.month.'.$i) }}</option>
                                @endfor
                            </select>
                            <select name="awarddate_year" id="awarddate_year">
                                <option value="0">{{trans('app.games.gamefiles.year')}}</option>
                                @for($i = 1990; $i < date("Y") + 1; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <span>[<span class="req">req</span>] monat optional</span>
                    </div>
                </div>
            </div>
            <div class="foot">
                <input type="submit" value="{{trans('app.misc.send')}}">
            </div>
        </div>
        {!! Form::close() !!}

        {!! Form::open(['action' => ['AwardController@store_subcat']]) !!}
        <div class="rmarchivtbl" id="rmarchivbox_submitprod">
            <h2>auszeichnungsname hinzufügen</h2>
            <div class="content">
                <div class="formifier">
                    <div class="row" id="row_award">
                        <label for="award">award</label>
                        <select name="award" id="award">
                            <option value="0">Bitte auswählen</option>
                            @foreach($awards as $aw)
                                <option value="{{ $aw->pageid }}-{{ $aw->catid }}">
                                    {{ $aw->year }} - {{ $aw->pagetitle }} - {{ $aw->cattitle }}
                                    @if($aw->month <> 0)
                                        - {{ trans('app.misc.month.'.$aw->month) }}
                                    @endif
                                </option>
                            @endforeach
                        </select>
                        <span>[<span class="req">req</span>]</span>
                    </div>
                    <div class="row" id="row_awardsubcat">
                        <label for="awardsubcat">name:</label>
                        <input autocomplete="off" class="auto" name="awardsubcat" id="awardsubcat" placeholder="awardsubcat" value=""/>
                        <span> [<span class="req">req</span>]</span>
                    </div>
                </div>
            </div>
            <div class="foot">
                <input type="submit" value="{{trans('app.misc.send')}}">
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection