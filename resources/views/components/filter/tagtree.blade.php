@foreach($tags as $tag)
    @php
        $isParent= in_array($tag->title, $parents, strict:true);
        $depth = substr_count($tag->fullpath, "/");

    @endphp
    <div {{"style=".($isParent ? "" :"display:none;") . ($depth > 0 ? "padding-left:".$depth*18 ."px;" : "paddding-left:0px;")}} class="" data-component="tag" {{ $tag->parent_id ? "data-parentid=$tag->parent_id" : "" }} data-id="{{ $tag->id }}" data-path="{{ $tag->fullpath}}" data-used="{{$isParent || $depth > 0 ? "true" : "false"}}">
        <div data-element="icon" class="fa fa-chevron-right link-info"></div>
        <input type="checkbox" name="{{$tag->id}}" value="{{$tag->id}}" id="{{ $tag->id }}" class="form-check-input">
        </input>
        <label for="{{$tag->id}}" class="">{{$tag->title}}</label>
    </div>
@endforeach