@extends('layouts.app')
@section('pagetitle', trans('app.add_game'))
@section('content')
    @permission(('create-games'))
        <div class="container">
            <div class="row">
                <div class="page-header">
                    <h1>{{trans('app.add_game')}}</h1>
                    {!! Breadcrumbs::render('game-add') !!}
                </div>
            </div>
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
            {!! Form::open(['action' => ['GameController@store']]) !!}
            <div class="row">
                <div class="well">
                    <div class="form-horizontal">
                        <fieldset>
                            <legend>{{ trans('app.informations') }}</legend>
                            <div class="form-group">
                                <label for="title" class="col-lg-2 control-label">{{trans('app.gametitle')}} *</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Anno 1997">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="subtitle" class="col-lg-2 control-label">{{trans('app.gamesubtitle')}} *</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" id="subtitle" name="subtitle" placeholder="Erschaffung einer neuen Welt">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for='maker' class="col-lg-2 control-label">{{trans('app.maker')}} *</label>
                                <div class="col-lg-10">
                                    <select name='maker' id='maker' class="form-control">
                                        <option value="0">{{trans('app.choose_maker')}}</option>
                                        @foreach($makers as $maker)
                                            <option value="{{ $maker->id }}">{{ $maker->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class='form-group'>
                                <label class="col-lg-2 control-label" for='language'>{{trans('app.language')}} *</label>
                                <div class="col-lg-10">
                                    <select name='language' id='language' class="form-control">
                                        <option value="0">{{trans('app.choose_language')}}</option>
                                        @foreach($langs as $lang)
                                            <option value="{{ $lang->short }}">{{ $lang->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="atelier_id" class="col-lg-2 control-label">{{trans('app.atelier_id')}}</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" id="atelier_id" name="atelier_id" placeholder="1337">
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="well">
                    <div class="form-horizontal">
                        <fieldset>
                            <legend>{{trans('app.description')}}</legend>
                            <div class="content">
                                @include('_partials.markdown_editor')
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="well">
                    <div class="form-horizontal">
                        <fieldset>
                            <legend>
                                {{trans('app.links')}}
                            </legend>
                            <div class="form-group">
                                <label for="websiteurl" class="col-lg-2 control-label">{{trans('app.website')}}</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" id="websiteurl" name="websiteurl" placeholder="http://www.anno.de">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="youtube" class="col-lg-2 control-label">{{trans('app.trailer')}}</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" id="youtube" name="youtube" placeholder="https://www.youtube.com/watch?v=V7tKQ4AuOk8">
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="well">
                    <div class="form-horizontal">
                        <fieldset>
                            <legend>
                                {{trans('app.connections')}}
                            </legend>
                            <div class="form-group">
                                <label for="developer" class="col-lg-2 control-label">{{trans('app.developer')}} *</label>
                                <div class="col-lg-10" id="row_developer">
                                    <input autocomplete="off" type="text" class="form-control auto" id="developer" name="developer">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-10 col-lg-offset-2">
                                    <button type="reset" class="btn btn-default">{{ trans('app.cancel') }}</button>
                                    <button type="submit" class="btn btn-primary">{{ trans('app.submit') }}</button>
                                </div>
                            </div>
                        </fieldset>
                        <script type="text/javascript">
                            var sourcepath = new Bloodhound({
                                datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
                                queryTokenizer: Bloodhound.tokenizers.whitespace,
                                //prefetch: '../data/films/post_1960.json',
                                remote: {
                                    url: '/ac_developer/%QUERY',
                                    wildcard: '%QUERY'
                                }
                            });

                            $('#row_developer .auto').typeahead(null, {
                                name: 'developers',
                                display: 'value',
                                source: sourcepath,
                                limit: 5,
                                templates: {
                                    empty: [
                                        '<div class="empty-message">',
                                        '{{trans('app.developer_not_found')}}',
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
                </div>
            </div>

            {!! Form::close() !!}
        </div>
    @else
        @include('_partials.accessdenied')
    @endpermission
@endsection