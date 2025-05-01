{{--
 Dieses Template wird auf folgendem Weg includiert:

 @include('_partials.markdown_editor', ['edit_text' => $variable])
 --}}
 @vite('resources/assets/js/ckeditorSetup.js') <!-- Only load js on included pages to save bandwidth-->
 @csrf
 {{-- <div id="row_message">
    <textarea style="display:none;" name="msg" id="msg">@if(isset($edit_text)){{ $edit_text}}@endif</textarea>
</div> --}}
<div class="editor-container__editor">
    <div>
        <textarea class="editor" style="display:none;" name="msg" id="msg">@if(isset($edit_text)){{ $edit_text}}@endif</textarea>
    </div>
</div>

<script type="module">
    window.onload = () => {
        ClassicEditor.create(document.querySelector('.editor'), {...ckEditorConfig,
            simpleUpload: {
                uploadUrl: '/attachment/upload',
                withCredentials: true,
                headers: {
                    'X-CSRF-TOKEN': 'CSRF-Token',
                    Authorization: '{{csrf_token()}}'
                }
            },
            initialData:`{{ $edit_text ?? "" }}`})
    };
</script>

