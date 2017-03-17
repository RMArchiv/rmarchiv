{{--
 Dieses Template wird auf folgendem Weg includiert:

 @include('_partials.markdown_editor', ['edit_text' => $variable])
 --}}

<div id="row_message">
    <textarea style="display:none;" name="msg" id="msg">@if(isset($edit_text)){{ $edit_text}}@endif</textarea>
</div>

<script type="text/javascript">

    $(function () {
        $('textarea').inlineattachment({
            uploadUrl: '/attachment/upload',
        });

        var editor = editormd("row_message", {
            autofocus: false,
            width: "99%",
            height: 320,
            imageUpload    : true,
            imageFormats   : ["jpg", "jpeg", "gif", "png", "PNG", "JPG", "GIF", "JPEG"],
            imageUploadURL : "/attachment/upload",
            syncScrolling: "single",
            path: "/lib/",
            placeholder: "Markdown Text",
            watch: false,
            mode: "markdown",
            toolbarIcons : function() {
                return [
                    "undo", "redo", "|",
                    "bold", "del", "italic", "quote", "ucwords", "|",
                    "h1", "h2", "h3", "|",
                    "list-ul", "list-ol", "hr", "|",
                    "link", "image", "code", "code-block", "pagebreak", "|",
                    "watch", "preview", "fullscreen", "clear", "search"
                ]
            },
            lang : {
                name : "en",
                description : "Open source online Markdown editor.",
                tocTitle    : "Table of Contents",
                toolbar : {
                    undo             : "Rückgängig (Ctrl+Z)",
                    redo             : "Wiederherstellen (Ctrl+Y)",
                    bold             : "Fett",
                    del              : "Durchgestrichen",
                    italic           : "Kursiv",
                    quote            : "Zitat",
                    ucwords          : "Erster Buchstabe groß",
                    uppercase        : "Selection text convert to uppercase",
                    lowercase        : "Selection text convert to lowercase",
                    h1               : "Überschrift 1",
                    h2               : "Überschrift 2",
                    h3               : "Überschrift 3",
                    h4               : "Heading 4",
                    h5               : "Heading 5",
                    h6               : "Heading 6",
                    "list-ul"        : "Ungeordnete Liste",
                    "list-ol"        : "Nummerierte Liste",
                    hr               : "Horizontale Trennlinie",
                    link             : "Link",
                    "reference-link" : "Reference link",
                    image            : "Bild",
                    code             : "Code inline",
                    "preformatted-text" : "Preformatted text / Code block (Tab indent)",
                    "code-block"     : "Code block (Mehrere Sprachen)",
                    table            : "Tables",
                    datetime         : "Datetime",
                    emoji            : "Emoji",
                    "html-entities"  : "HTML Entities",
                    pagebreak        : "Seitenumbruch",
                    watch            : "Unwatch",
                    unwatch          : "Watch",
                    preview          : "HTML Preview (Press Shift + ESC exit)",
                    fullscreen       : "Fullscreen (Press ESC exit)",
                    clear            : "Clear",
                    search           : "Search",
                    help             : "Help",
                    info             : "Info"
                },
                buttons : {
                    enter  : "Senden",
                    cancel : "Abbrechen",
                    close  : "Schließen"
                },
                dialog : {
                    link : {
                        title    : "Link",
                        url      : "Address",
                        urlTitle : "Title",
                        urlEmpty : "Error: Please fill in the link address."
                    },
                    referenceLink : {
                        title    : "Reference link",
                        name     : "Name",
                        url      : "Address",
                        urlId    : "ID",
                        urlTitle : "Title",
                        nameEmpty: "Error: Reference name can't be empty.",
                        idEmpty  : "Error: Please fill in reference link id.",
                        urlEmpty : "Error: Please fill in reference link url address."
                    },
                    image : {
                        title    : "Image",
                        url      : "Bild URL:",
                        link     : "Link zu:",
                        alt      : "Titel:",
                        uploadButton     : "Upload",
                        imageURLEmpty    : "Error: picture url address can't be empty.",
                        uploadFileEmpty  : "Error: upload pictures cannot be empty!",
                        formatNotAllowed : "Error: only allows to upload pictures file, upload allowed image file format:"
                    },
                    preformattedText : {
                        title             : "Preformatted text / Codes",
                        emptyAlert        : "Error: Please fill in the Preformatted text or content of the codes."
                    },
                    codeBlock : {
                        title             : "Code block",
                        selectLabel       : "Languages: ",
                        selectDefaultText : "select a code language...",
                        otherLanguage     : "Other languages",
                        unselectedLanguageAlert : "Error: Please select the code language.",
                        codeEmptyAlert    : "Error: Please fill in the code content."
                    },
                    htmlEntities : {
                        title : "HTML Entities"
                    },
                    help : {
                        title : "Help"
                    }
                }
            }
        })
    });
</script>

