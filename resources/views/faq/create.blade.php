@extends('layouts.app')
@section('content')
@section('pagetitle', trans('faq.create.title'))
@permission(('create-faq'))
<div id="content">
    <form action="{{ url('faq') }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="rmarchivtbl" id="rmarchivbox_submitfaq">
            <h2>{{ trans('faq.create.title_long') }}</h2>

            @if (count($errors) > 0)
                <div class="rmarchivtbl errorbox">
                    <h2>{{ trans('faq.create.title') }}</h2>
                    <div class="content">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li><strong>{{ $error }}</strong></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <div class="content">
                <div class="formifier">
                    <div class="row" id="row_cat">
                        <label for="cat">{{ trans('faq.create.category') }}:</label>
                        <input autocomplete="off" class="auto" name="cat" id="cat" value=""/>
                        <span> [<span class="req">req</span>]</span>
                    </div>
                    <div class="row" id="row_title">
                        <label for="title">{{ trans('faq.create.question') }}:</label>
                        <input name="title" id="msg" value=""/>
                        <span> [<span class="req">req</span>]</span>
                    </div>
                        @include('_partials.markdown_editor')
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
                            'Nichts gefunden.',
                            '</div>'
                        ].join('\n'),
                        suggestion: function(data) {
                            console.log(data);
                            return '<p><strong>' + data.value + '</strong></p>';
                        }
                    }
                });
            </script>
            <div class="foot">
                <input type="submit" value="{{ trans('faq.create.send') }}">
            </div>
        </div>
    </form>
</div>
@else
    @include('_partials.accessdenied')
@endpermission
@endsection
