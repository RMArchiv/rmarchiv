@extends('layouts.app')
@section('pagetitle', trans('app.add_faq'))
@section('content')
@permission(('create-faq'))
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h1>{{ trans('app.add_faq') }}</h1>
                {!! Breadcrumbs::render('faq-add') !!}
            </div>
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
        <div class="col-md-12">
            <form action="{{ url('faq') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="card">
                    <div class="card-header">
                        {{trans('app.add_faq')}}
                    </div>
                    <div class="card-body">
                        <div class="form-group" id="row_cat">
                            <label for="cat" class="col-lg-2 col-form-label">{{trans('app.faq_category')}} *</label>
                            <div class="col-lg-10" id="row_cat">
                                <input autocomplete="off" class="auto" name="cat" id="cat" value=""/>
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
                        <div class="form-group">
                            <label for="msg" class="col-lg-2 col-form-label">{{trans('app.faq_question')}} *</label>
                            <div class="col-lg-10">
                                <input name="title" id="msg" value=""/>
                            </div>
                        </div>
                        <div class="form-group">
                            @include('_partials.markdown_editor')
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="reset" class="btn btn-secondary">{{ trans('app.cancel') }}</button>
                        <button type="submit" class="btn btn-primary">{{ trans('app.submit') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@else
    @include('_partials.accessdenied')
@endpermission
@endsection
