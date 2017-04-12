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
            <h2>{{ trans('app.awards.create.website.title') }}</h2>
            <div class="content">
                <div class="formifier">
                    <div class="row" id="row_awardpage">
                        <label for="awardpage">{{ trans('app.awards.create.website.website') }}</label>
                        <input autocomplete="off" class="auto" name="awardpage" id="awardpage" placeholder="awardpage" value=""/>
                        <span> [<span class="req">req</span>] <br>{{ trans('app.awards.create.website.website_info') }}</span>
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
                                    '{{trans('app.awards.create.website.website_notfound')}}',
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
                        <label for="awardpageurl">{{ trans('app.awards.create.website.url') }}</label>
                        <input name="awardpageurl" id="awardpageurl" placeholder="url" value=""/>
                    </div>
                </div>
            </div>
            <div class="foot">
                <input type="submit" value="{{trans('app.awards.create.website.send')}}">
            </div>
        </div>
        {!! Form::close() !!}

        {!! Form::open(['action' => ['AwardController@store_cat']]) !!}
        <div class="rmarchivtbl" id="rmarchivbox_submitprod">
            <h2>{{ trans('app.awards.create.award.title') }}</h2>
            <div class="content">
                <div class="formifier">
                    <div class="row" id="row_awardpage">
                        <label for="awardpage">{{trans('app.awards.create.award.website')}}</label>
                        <select name="awardpage" id="awardpage">
                            <option value="0">{{ trans('app.awards.create.award.please_choose') }}</option>
                            @foreach($pages as $page)
                                <option value="{{ $page->id }}">{{ $page->title }}</option>
                            @endforeach
                        </select>
                        <span>[<span class="req">req</span>]</span>
                    </div>
                    <div class="row" id="row_awardname">
                        <label for="awardname">{{ trans('app.awards.create.award.name') }}</label>
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
                                    '{{trans('app.awards.create.award.not_found')}}',
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
                        <label for="awarddate">{{trans('app.awards.create.award.date')}}</label>
                        <div class="formdate" id="awarddate">
                            <select name="awarddate_month" id="awarddate_month">
                                <option value="0">{{trans('app.misc.dates.month.title')}}</option>
                                @for($i = 1; $i < 13; $i++)
                                    <option value="{{ $i }}">{{ trans('app.misc.dates.month.long.'.$i) }}</option>
                                @endfor
                            </select>
                            <select name="awarddate_year" id="awarddate_year">
                                <option value="0">{{trans('app.misc.dates.year.title')}}</option>
                                @for($i = 1990; $i < date("Y") + 1; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <span>[<span class="req">req</span>] {{ trans('app.awards.create.award.month_info') }}</span>
                    </div>
                </div>
            </div>
            <div class="foot">
                <input type="submit" value="{{trans('app.awards.create.award.send')}}">
            </div>
        </div>
        {!! Form::close() !!}

        {!! Form::open(['action' => ['AwardController@store_subcat']]) !!}
        <div class="rmarchivtbl" id="rmarchivbox_submitprod">
            <h2>{{ trans('app.awards.create.category.title') }}</h2>
            <div class="content">
                <div class="formifier">
                    <div class="row" id="row_award">
                        <label for="award">{{ trans('app.awards.create.category.award') }}</label>
                        <select name="award" id="award">
                            <option value="0">{{ trans('app.awards.create.category.please_choose') }}</option>
                            @foreach($awards as $aw)
                                <option value="{{ $aw->pageid }}-{{ $aw->catid }}">
                                    {{ $aw->year }} - {{ $aw->pagetitle }} - {{ $aw->cattitle }}
                                    @if($aw->month <> 0)
                                        - {{ trans('app.misc.dates.month.short.'.$aw->month) }}
                                    @endif
                                </option>
                            @endforeach
                        </select>
                        <span>[<span class="req">req</span>]</span>
                    </div>
                    <div class="row" id="row_awardsubcat">
                        <label for="awardsubcat">{{ trans('app.awards.create.category.name') }}</label>
                        <input autocomplete="off" class="auto" name="awardsubcat" id="awardsubcat" placeholder="{{ trans('app.awards.create.category.name') }}" value=""/>
                        <span> [<span class="req">req</span>]</span>
                    </div>
                </div>
            </div>
            <div class="foot">
                <input type="submit" value="{{trans('app.awards.create.category.send')}}">
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection