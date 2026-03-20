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
            @include('_partials.markdown_editor', ['edit_text' => old('msg', $faqEntry->desc_md)])
        </div>
    </div>
    <div class="card-footer">
        <a href="{{ url('faq') }}" class="btn btn-secondary">{{ trans('app.cancel') }}</a>
        <button type="submit" class="btn btn-primary">{{ $submitLabel }}</button>
    </div>
</div>
