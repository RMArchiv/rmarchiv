@extends('layouts.app')
@section('pagetitle', trans('app.add_award'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h1>{{ trans('app.add_award') }}</h1>
                    {!! Breadcrumbs::render('awards.catadd') !!}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                @if (count($errors) > 0)
                    <div class="row">
                        <div class="alert alert-dismissible alert-warning">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <h4>Fehler!</h4>
                            <p>
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li><strong>{{ $error }}</strong></li>
                                @endforeach
                            </ul>
                            </p>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 mb-3">
                {!! Form::open(['action' => ['AwardController@store_page']]) !!}
                <div class="card">
                    <div class="card-header">
                        {{ trans('app.add_award_website') }}
                    </div>
                    <div class="card-body">
                        <div class="form-group" id="row_awardpage">
                            <label for="awardpage">{{ trans('app.add_award_website') }}</label>
                            <input autocomplete="off" class="auto form-control" name="awardpage" id="awardpage" placeholder="awardpage" value=""/>
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
                                            '{{trans('app.award_website_not_found')}}',
                                            '</div>'
                                        ].join('\n'),
                                        suggestion: function(data) {
                                            console.log(data);
                                            return '<p><strong>' + data.value + '</strong></p>';
                                        }
                                    }
                                });
                            </script>
                        </div>
                        <div class="form-group">
                            <label for="awardpageurl">{{ trans('app.website_url') }}</label>
                            <input class="form-control" name="awardpageurl" id="awardpageurl" placeholder="url" value=""/>
                        </div>
                    </div>
                    <div class="card-footer">
                        <input type="submit" class="btn btn-primary" value="{{trans('app.submit')}}">
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mb-3">
                {!! Form::open(['action' => ['AwardController@store_cat']]) !!}
                <div class="card">
                    <div class="card-header">
                        {{ trans('app.add_award') }}
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="awardpage">{{trans('app.award_website')}}</label>
                            <select class="form-control" name="awardpage" id="awardpage">
                                <option value="0">{{ trans('app.choose_award_website') }}</option>
                                @foreach($pages as $page)
                                    <option value="{{ $page->id }}">{{ $page->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group" id="row_awardname">
                            <label for="awardname">{{ trans('app.award_title') }}</label>
                            <input autocomplete="off" class="auto form-control" name="awardname" id="awardname" placeholder="awardname" value=""/>
                        </div>
                        <script type="text/javascript">
                            var sourcepath = new Bloodhound({
                                datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
                                queryTokenizer: Bloodhound.tokenizers.whitespace,
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
                                        '{{trans('app.award_not_found')}}',
                                        '</div>'
                                    ].join('\n'),
                                    suggestion: function(data) {
                                        console.log(data);
                                        return '<p><strong>' + data.value + '</strong></p>';
                                    }
                                }
                            });
                        </script>
                        <div class="form-group">
                            <label for="awarddate">{{trans('app.created_at')}}</label>
                            <div class="form-inline" id="awarddate">
                                <select class="form-control" name="awarddate_month" id="awarddate_month">
                                    <option value="0">{{trans('app.created_at_month')}}</option>
                                    @for($i = 1; $i < 13; $i++)
                                        <option value="{{ $i }}">{{ trans('app.month.'.$i) }}</option>
                                    @endfor
                                </select>
                                <select class="form-control" name="awarddate_year" id="awarddate_year">
                                    <option value="0">{{trans('app.created_at_year')}}</option>
                                    @for($i = 1990; $i < date("Y") + 1; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                                {{ trans('app.award_month_optional') }}
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <input class="btn btn-primary" type="submit" value="{{trans('app.submit')}}">
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mb-3">
                {!! Form::open(['action' => ['AwardController@store_subcat']]) !!}
                <div class="card">
                    <div class="card-header">
                        {{ trans('app.add_award_category') }}
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="award">{{ trans('app.award_category') }}</label>
                            <select class="form-control" name="award" id="award">
                                <option value="0">{{ trans('app.choose_award_category') }}</option>
                                @foreach($awards as $aw)
                                    <option value="{{ $aw->pageid }}-{{ $aw->catid }}">
                                        {{ $aw->year }} - {{ $aw->pagetitle }} - {{ $aw->cattitle }}
                                        @if($aw->month <> 0)
                                            - {{ trans('app.month.'.$aw->month) }}
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="awardsubcat">{{ trans('app.award_category_title') }}</label>
                            <input autocomplete="off" class="auto form-control" name="awardsubcat" id="awardsubcat" placeholder="{{ trans('app.award_category_title') }}" value=""/>
                        </div>
                    </div>
                    <div class="card-footer">
                        <input class="btn btn-primary" type="submit" value="{{trans('app.submit')}}">
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection