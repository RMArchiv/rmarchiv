@extends('layouts.app')
@section('pagetitle', trans('app.add_faq'))
@section('content')
@permission(('create-faq'))
<div class="container">
    <div class="row">
        <div class="page-header">
            <h1>{{ trans('app.add_faq') }}</h1>
            {!! Breadcrumbs::render('faq-add') !!}
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
    <div class="row">
        <div id="content">
            <form action="{{ url('faq') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="well">
                    <div class="form-horizontal">
                        <fieldset>
                            <legend>{{trans('app.add_faq')}}</legend>
                            <div class="form-group">
                                <label for="cat" class="col-lg-2 col-form-label">{{trans('app.faq_category')}} *</label>
                                <div class="col-lg-10" id="row_cat">
                                    <input autocomplete="off" class="auto" name="cat" id="cat" value=""/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="msg" class="col-lg-2 col-form-label">{{trans('app.faq_question')}} *</label>
                                <div class="col-lg-10">
                                    <input name="title" id="msg" value=""/>
                                </div>
                            </div>

                            <div class="content">
                                @include('_partials.markdown_editor')
                            </div>

                            <div class="form-group">
                                <div class="col-lg-10 col-lg-offset-2">
                                    <button type="reset" class="btn btn-secondary">{{ trans('app.cancel') }}</button>
                                    <button type="submit" class="btn btn-primary">{{ trans('app.submit') }}</button>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
                    <script type="text/javascript">
                        var sourcepath = new Bloodhound({
                            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
                            queryTokenizer: Bloodhound.tokenizers.whitespace,
                            //prefetch: '../data/films/post_1960.json',
                            remote: {
                                url: '/ac_faqcat/%QUERY',
                                wildcard: '%QUERY'
                            }
                        });

                        $('#row_cat .auto').typeahead(null, {
                            name: 'cat',
                            display: 'value',
                            source: sourcepath,
                            limit: 5,
                            templates: {
                                empty: [
                                    '<div class="empty-message">',
                                    '{{ trans('app.faq_cat_not_found') }}',
                                    '</div>'
                                ].join('\n'),
                                suggestion: function(data) {
                                    console.log(data);
                                    return '<p><strong>' + data.value + '</strong></p>';
                                }
                            }
                        });
                    </script>
            </form>
        </div>
    </div>
</div>

@else
    @include('_partials.accessdenied')
@endpermission
@endsection
