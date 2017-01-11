<div class='rmarchivtbl' id='rmarchivbox_search'>
    <h2>suche</h2>
    {{ Form::open(['action' => ['SearchController@search']]) }}
        <div class='content center'>
            <input type='text' name='term' size='64' />
        </div>
        <div class='foot'>
            <input type='submit' value='Submit' />
        </div>
    {{ Form::close() }}
</div>