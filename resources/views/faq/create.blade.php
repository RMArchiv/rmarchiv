@extends('layouts.app')
@section('content')
@section('pagetitle', 'faq erstellen')
@permission(('create-faq'))
<div id="content">
    <form action="{{ url('faq') }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="rmarchivtbl" id="rmarchivbox_submitfaq">
            <h2>Eintragen eines neuen FAQ Eintrags</h2>

            @if (count($errors) > 0)
                <div class="rmarchivtbl errorbox">
                    <h2>faq hinzufügen</h2>
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
                        <label for="cat">faq kategorie:</label>
                        <input autocomplete="off" class="auto" name="cat" id="cat" value=""/>
                        <span> [<span class="req">req</span>]</span>
                    </div>
                    <div class="row" id="row_title">
                        <label for="title">frage:</label>
                        <input name="title" id="msg" value=""/>
                        <span> [<span class="req">req</span>]</span>
                    </div>
                    <div class="row" id="row_desc">
                        <label for="desc">antwort:</label>
                        <textarea name="desc" id="desc" maxlength="9999" rows="10" placeholder="FAQ Antwort"></textarea>
                        <script type="text/javascript">
                            $(function() {
                                $('textarea').inlineattachment({
                                    uploadUrl: 'http://rmarchiv.de/attachment/upload',
                                });
                            });
                        </script>
                        <span> [<span class="req">req</span>] Markdown!</span>
                    </div>
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
                <input type="submit" value="senden">
            </div>
        </div>
    </form>
</div>
@else
    @include('_partials.accessdenied')
@endpermission
@endsection
