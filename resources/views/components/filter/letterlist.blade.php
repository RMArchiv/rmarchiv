<div class="btn-group row w-100 flex-wrap">
@foreach ($letters as $letter)
    <div class="btn btn-secondary col-auto">
        {{$letter->firstletter}}
    </div>
@endforeach
</div>