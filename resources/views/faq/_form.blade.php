<div class="card">
    <div class="card-header">
        {{ $submitLabel }}
    </div>
    <div class="card-body">
        <div class="form-group">
            <label for="cat" class="col-lg-2 col-form-label">{{ trans('app.faq_category') }} *</label>
            <div class="col-lg-10">
                <input autocomplete="off" name="cat" id="cat" value="{{ old('cat', $faqEntry->cat) }}"/>
            </div>
        </div>
        <div class="form-group">
            <label for="title" class="col-lg-2 col-form-label">{{ trans('app.faq_question') }} *</label>
            <div class="col-lg-10">
                <input name="title" id="title" value="{{ old('title', $faqEntry->title) }}"/>
            </div>
        </div>
        <div class="form-group">
            @php($msg = old('msg', $faqEntry->desc_md))
            @include('_partials.markdown_editor')
        </div>
    </div>
    <div class="card-footer">
        <button type="reset" class="btn btn-secondary">{{ trans('app.cancel') }}</button>
        <button type="submit" class="btn btn-primary">{{ $submitLabel }}</button>
    </div>
</div>
