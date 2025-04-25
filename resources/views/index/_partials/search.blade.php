<div class="row mt-4">
    <div class="card">
        <div class="card-header">{{ trans('app.search') }}</div>
        <div class="card-body">
            {{ Form::open(['action' => ['SearchController@search']], ['class' => 'form-horizontal']) }}
                <input id="term" type='text' name='term' />
                <input id="term" type='submit' value='Submit' />
            <script type="module">
                    addSearch({
                        targetQuery: "#term",
                        apiPath: "ac_search",
                        emptyTemplate: [
                            '<div class="empty-message">',
                            '{{ trans('app.search_nothing_found') }}',
                            '</div>'
                        ].join('\n'),
                        name: "term",
                        display: "title",
                        suggestionFunction: (data) => return data.value;
                    });
            </script>
            {{ Form::close() }}
        </div>
    </div>
</div>