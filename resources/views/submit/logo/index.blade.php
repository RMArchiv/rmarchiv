@extends('layouts.app')

@section('content')
<div id="content">
    <form action="/?page=submit" method="post" enctype="multipart/form-data">
        <input type="hidden" name="posttype" value="logo">
        <input type="hidden" name="MAX_FILE_SIZE" value="30000" />

        <div class="rmarchivtbl" id="rmarchivbox_submitavatar">
            <h2>Upload eines neuen Logos</h2>

            <div class="content">
                <div class="formifier">
                    <div class="row" id="row_name">
                        <label for="logoname">logo name:</label>
                        <input name="logoname" id="logoname" value=""/>
                        <span> [<span class="req">req</span>]</span>
                    </div>
                    <div class="row" id="row_file">
                        <label for="file">datei wählen:</label>
                        <input name="file" id="file" type="file" value=""/>
                        <span> [<span class="req">req</span>]</span>
                    </div>
                </div>
            </div>
            <div class="foot">
                <input type="submit" value="Upload Logo">
            </div>
        </div>
    </form>
</div>
@endsection