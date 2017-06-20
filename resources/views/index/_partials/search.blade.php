<div class="row">
    <div class="panel panel-default">
        <div class="panel-heading">{{ trans('app.search') }}</div>
        <div class="panel-body">
            {{ Form::open(['action' => ['SearchController@search']], ['class' => 'form-horizontal']) }}
                <input id="term" type='text' name='term' />
                <input id="term" type='submit' value='Submit' />
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
                            '{{ trans('app.search_nothing_found') }}',
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
    </div>
</div>