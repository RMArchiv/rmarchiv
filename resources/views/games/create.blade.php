@extends('layouts.app')
@section('pagetitle', trans('app.add_game'))
@section('content')
    <div class="container">
        @permission(('create-games'))
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>{{trans('app.add_game')}}</h1>
                        {!! Breadcrumbs::render('game-add') !!}
                    </div>
                </div>
            </div>
            @if (count($errors) > 0)
                <div class="row">
                    <div class="alert alert-dismissible alert-warning">
                        <button type="button" class="close" data-bs-dismiss="alert">&times;</button>
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
            <form method="POST" action="{{ action("GameController@store") }}">
                @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            {{ trans('app.information') }}
                        </div>
                        <div class="card-body">
                            <div class="form-horizontal">
                                <fieldset>
                                    <legend></legend>
                                    <div class="form-group">
                                        <label for="title" class="col-lg-2 col-form-label">{{trans('app.gametitle')}} *</label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control" id="title" name="title" placeholder="Anno 1997">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="subtitle" class="col-lg-2 col-form-label">{{trans('app.gamesubtitle')}}</label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control" id="subtitle" name="subtitle" placeholder="Erschaffung einer neuen Welt">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for='maker' class="col-lg-2 col-form-label">{{trans('app.maker')}} *</label>
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
                                        <label class="col-lg-2 col-form-label" for='language'>{{trans('app.language')}} *</label>
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
                                        <label for="atelier_id" class="col-lg-2 col-form-label">{{trans('app.atelier_id')}}</label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control" id="atelier_id" name="atelier_id" placeholder="1337">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for='license' class="col-lg-2 col-form-label">{{trans('app.license')}} *</label>
                                        <div class="col-lg-10">
                                            <select name='license' id='license' class="form-control">
                                                <option value="0">{{trans('app.choose_license')}}</option>
                                                @foreach($licenses as $maker)
                                                    <option value="{{ $maker->id }}">{{ $maker->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            {{trans('app.description')}}
                        </div>
                        <div class="card-body">
                            <div class="form-horizontal">
                                <fieldset>
                                    <legend></legend>
                                    <div class="content">
                                        @include('_partials.markdown_editor')
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            {{trans('app.links')}}
                        </div>
                        <div class="card-body">
                            <div class="form-horizontal">
                                <fieldset>
                                    <legend>

                                    </legend>
                                    <div class="form-group">
                                        <label for="websiteurl" class="col-lg-2 col-form-label">{{trans('app.website')}}</label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control" id="websiteurl" name="websiteurl" placeholder="http://www.anno.de">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="youtube" class="col-lg-2 col-form-label">{{trans('app.trailer')}}</label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control" id="youtube" name="youtube" placeholder="https://www.youtube.com/watch?v=V7tKQ4AuOk8">
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mb-3">
                    <div class="card">
                        <div class="card-header">
                            {{trans('app.connections')}}
                        </div>
                        <div class="card-body">
                            <div class="form-horizontal">
                                <fieldset>
                                    <legend>

                                    </legend>
                                    <div class="form-group">
                                        <label for="developer" class="col-lg-2 col-form-label">{{trans('app.developer')}} *</label>
                                        <div class="col-lg-10" id="row_developer">
                                            <input autocomplete="off" type="text" class="d-none form-control auto" id="developer" name="developer">
                                            <div class="searchbar"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-10 col-lg-offset-2">
                                            <button type="reset" class="btn btn-secondary">{{ trans('app.cancel') }}</button>
                                            <button type="submit" class="btn btn-primary">{{ trans('app.submit') }}</button>
                                        </div>
                                    </div>
                                </fieldset>
                                <script type="module">
                                    createAutocomplete({
                                        apiPath: ()=>{return "ac_developer"},
                                        placeholder: "{{ trans('app.search') }}",
                                        searchbarSelector:"#row_developer .searchbar",
                                        noResults:'{{ trans('app.developer_not_found') }}',
                                        type:"list",
                                        action:"find",
                                        inputSelector:"#row_developer .auto",
                                        limit:5,
                                        additionalProps:{}
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            </form>
        @else
            @include('_partials.accessdenied')
        @endif
        @endpermission
    </div>
@endsection