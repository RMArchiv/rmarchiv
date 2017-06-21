@extends('layouts.app')
@section('pagetitle', trans('app.add_game_to_award'))
@section('content')
    <div class="content">
        @if (count($errors) > 0)
            <div class="rmarchivtbl errorbox">
                <h2>{{ trans('app.add_game_to_award') }}</h2>
                <div class="content">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li><strong>{{ $error }}</strong></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        {!! Form::open(['action' => ['AwardController@gameadd_store']]) !!}
        <input name="subcatid" type="hidden" value="{{ $subcatid }}">
        <div class="rmarchivtbl" id="rmarchivbox_submitprod">
            <h2>{{ trans('app.add_game_to_award') }}</h2>
            <div class="content">
                <div class="formifier">
                    <div class="row" id="row_game">
                        <label for="game">{{ trans('app.gametitle') }}</label>
                        <input autocomplete="off" class="auto" name="game" id="game" placeholder="{{ trans('app.gametitle') }}" value=""/>
                        <span> [<span class="req">req</span>]</span>
                    </div>
                    <script type="text/javascript">
                        var sourcepath = new Bloodhound({
                            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
                            queryTokenizer: Bloodhound.tokenizers.whitespace,
                            //prefetch: '../data/films/post_1960.json',
                            remote: {
                                url: '/ac_games/%QUERY',
                                wildcard: '%QUERY'
                            }
                        });

                        $('#row_game .auto').typeahead(null, {
                            name: 'game',
                            display: 'id',
                            source: sourcepath,
                            limit: 9,
                            templates: {
                                empty: [
                                    '<div style="color: #00001a;">',
                                    '{{trans('app.game_not_found')}}',
                                    '</div>'
                                ].join('\n'),
                                suggestion: function(data) {
                                    console.log(data);
                                    return '<p><strong>' + data.value + '</strong></p>'
                                }
                            }
                        });
                    </script>
                    <div class="row" id="row_place">
                        <label for="place">{{ trans('app.place') }}</label>
                        <input autocomplete="off" class="auto" name="place" id="place" placeholder="1" value=""/>
                        <span> [<span class="req">req</span>]</span>
                    </div>
                    <div class="row" id="row_desc">
                        <label for="desc">{{ trans('app.description') }}</label>
                        <input autocomplete="off" class="auto" name="desc" id="desc" placeholder="123 points" value=""/>
                    </div>
                </div>
            </div>
            <div class="foot">
                <input type="submit" value="{{trans('app.submit')}}">
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection