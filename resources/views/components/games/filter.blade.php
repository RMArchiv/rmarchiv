<div class="d-flex gap-2 py-2">
    <form name="maker" action="{{Request::url()}}">
        <noscript>
        <div class="d-flex gap-2">
            <div class="input-group input-group-sm">
                <label class="input-group-text" for="maker-select">{{ trans('app.maker') }}</label>

                <select id="maker-select" class="form-select" name="maker" title="{{ trans('app.maker') }}">
                    <option value="" selected>{{ trans('app.filter.all') }}</option>
                    @foreach ($makers as $maker)
                        @if ($maker->id == request()->get('maker'))
                            <option selected value="{{ $maker->id }}">{{ $maker->title }}</option>
                        @else
                            <option value="{{ $maker->id }}">{{ $maker->title }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="input-group input-group-sm">
                <label class="input-group-text" for="language-select">{{ trans('app.language') }}</label>

                <select id="language-select" class="form-select" name="language" title="{{ trans('app.language') }}">
                    <option value="" selected>{{ trans('app.filter.all') }}</option>
                    @foreach ($languages as $language)
                        @if ($language->id == request()->get('language'))
                            <option selected value="{{ $language->id }}">{{ $language->name }}</option>
                        @else
                            <option value="{{ $language->id }}">{{ $language->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="input-group input-group-sm">
                <label class="input-group-text" for="tag-select">{{ trans('app.tags') }}</label>

                <select id="tag-select" class="form-select" name="tag" title="{{ trans('app.tags') }}">
                    <option value="" selected>{{ trans('app.filter.all') }}</option>
                    @foreach ($tags as $tag)
                        @if ($tag->id == request()->get('tag'))
                            <option selected value="{{ $tag->id }}">{{ $tag->title }}</option>
                        @else
                            <option value="{{ $tag->id }}">{{ $tag->title }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <button class="btn btn-secondary" title="filter">Filter</button>
        </div>
        </noscript>

        <div class="d-flex gap-2">
            <div class="input-group input-group-sm">
                <label class="input-group-text" for="maker-select">{{ trans('app.maker') }}</label>

                <select id="maker-select" class="form-select" name="maker" title="{{ trans('app.maker') }}">
                    <option value="" selected>{{ trans('app.filter.all') }}</option>
                    @foreach ($makers as $maker)
                        @if ($maker->id == request()->get('maker'))
                            <option selected value="{{ $maker->id }}">{{ $maker->title }}</option>
                        @else
                            <option value="{{ $maker->id }}">{{ $maker->title }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="input-group input-group-sm">
                <label class="input-group-text" for="language-select">{{ trans('app.language') }}</label>

                <select id="language-select" class="form-select" name="language" title="{{ trans('app.language') }}">
                    <option value="" selected>{{ trans('app.filter.all') }}</option>
                    @foreach ($languages as $language)
                        @if ($language->id == request()->get('language'))
                            <option selected value="{{ $language->id }}">{{ $language->name }}</option>
                        @else
                            <option value="{{ $language->id }}">{{ $language->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="input-group input-group-sm">
                <label class="input-group-text" for="tag-select">{{ trans('app.tags') }}</label>

                <select id="tag-select" class="form-select" name="tag" title="{{ trans('app.tags') }}">
                    <option value="" selected>{{ trans('app.filter.all') }}</option>
                    @foreach ($tags as $tag)
                        @if ($tag->id == request()->get('tag'))
                            <option selected value="{{ $tag->id }}">{{ $tag->title }}</option>
                        @else
                            <option value="{{ $tag->id }}">{{ $tag->title }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <button class="btn btn-secondary" title="filter">Filter</button>
        </div>

    </form>

</div>