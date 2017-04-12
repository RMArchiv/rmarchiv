<div class='rmarchivtbl' id='rmarchivbox_search'>
    <h2>{{ trans('index.search.title') }}</h2>
    {{ Form::open(['action' => ['SearchController@search']]) }}
        <div class='content center'>
            <input id="term" type='text' name='term' size='64' />
        </div>
        <div class='foot'>
            <input id="term" type='submit' value='Submit' />
        </div>
    <script type="text/javascript">
        var sourcepath = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            //prefetch: '../data/films/post_1960.json',
            remote: {
                url: '/ac_search/%QUERY',
                wildcard: '%QUERY'
            }
        });

        $('#term').typeahead(null, {
            name: 'term',
            display: 'title',
            source: sourcepath,
            limit: 5,
            templates: {
                empty: [
                    '<div class="empty-message">',
                    '{{ trans('index.search.not_found') }}',
                    '</div>'
                ].join('\n'),
                suggestion: function(data) {
                    console.log(data);
                    return data.value;
                }
            },
            classNames: {
                menu: 'search_menu',
            }
        });
    </script>
    {{ Form::close() }}
</div>