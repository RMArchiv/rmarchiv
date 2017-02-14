{{--
 Dieses Template wird auf folgendem Weg includiert:

 @include('_partials.markdown_editor', ['edit_text' => $variable])
 --}}

<script>
    $(function () {
        $("#tabs_edit").tabs();
    });
</script>
<div id="tabs_edit" class="style-tabs" style="width: 99%;">
    <ul>
        <li><a href="#tabs-1">bearbeiten</a></li>
        <li><a href="#tabs-2" id="preview">vorschau</a></li>
    </ul>
    <div id="tabs-1">
        <div class="row" id="row_message">
            <label for="msg">text:</label>
            <textarea name="msg" id="msg" maxlength="9999" rows="10" style="width: 99%;"
                      placeholder="Markdown Text">@if(isset($edit_text)) {{ $edit_text}} @endif</textarea>
        </div>
        <script type="text/javascript">
            $(function () {
                $('textarea').inlineattachment({
                    uploadUrl: 'http://rmarchiv.de/attachment/upload',
                });
            });
        </script>
    </div>
    <div id="tabs-2">
        <div class="rmarchivtbl rmarchivbox_newsbox" id="rmarchivbox_prodmain">
            <h2>live preview</h2>
            <div class="content" id="preview_box">

            </div>
            <script>
                var reader = new commonmark.Parser();
                var writer = new commonmark.HtmlRenderer();
                var parsed = reader.parse(document.getElementById('msg').value);
                var result = writer.render(parsed);
                document.getElementById('preview_box').innerHTML = result;

                document.getElementById('preview').onclick = function () {
                    var reader = new commonmark.Parser();
                    var writer = new commonmark.HtmlRenderer();
                    var parsed = reader.parse(document.getElementById('msg').value);
                    var result = writer.render(parsed);
                    document.getElementById('preview_box').innerHTML = result;
                }
            </script>

        </div>
    </div>
</div>