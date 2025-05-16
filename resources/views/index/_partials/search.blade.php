<div class="row mt-4">
    <div class="card">
        <div class="card-header">{{ trans('app.search') }}</div>
        <div class="card-body">
            <form method="GET" action="{{action('SearchController@search')}}" class="form-horizontal" >
            @csrf
                <input class="d-none" id="term" type='text' name='term' />
                <div id="termbar" class="searchbar"></div>
                <input id="term" type='submit' value='Submit' />
            <script type="module">
                    createAutocomplete({
                        apiPath: ()=>{return "ac_search_new"},
                        placeholder: "{{ trans('app.search') }}",
                        searchbarSelector:"#termbar",
                        noResults:'{{ trans('app.developer_not_found') }}',
                        type:"games",
                        action:"navigate",
                        inputSelector:"#term",
                        limit:5,
                        additionalProps:{}
                    });
            </script>
            </form>
        </div>
    </div>
</div>