<div class="recipient-section">

    {{-- recipient list --}}
    <div class="input-group mb-2">
        <label for="select"
            class="input-group-text">{{ trans('app.recipients') }}*</label>
        <div id="recipient-list" class="form-control d-flex gap-1 flex-wrap ">
        @foreach ($preselect as $user)
            <button type="button" data-userid={{$user->id}} data-username={{$user->name}}
            onclick="removeRecipient(event)"
            class="btn-group btn btn-secondary d-flex flex-shrink gap-2 align-items-center"
            data-toggle="buttons">
                <input id="{{$user->name.'-'.$user->id}}" class="d-none form-check-input" type="checkbox" autocomplete="off"
                    name="recipients[]" value="{{ $user->id}}" checked="true">
                <div class="btn-secondary fa fa-xmark w-auto"></div>
                <label for="{{$user->name.'-'.$user->id}}" class="">{{$user->name}}</label>
            </button>
        @endforeach
        </div>

    </div>
    {{-- template for recipient button --}}
    <template>
        <button data-userid="0" data-username=""
            class="btn-group btn btn-secondary d-flex flex-shrink gap-2 align-items-center"
            type="button"
            data-toggle="buttons">
            <input id="" class="d-none form-check-input" type="checkbox" autocomplete="off"
                name="recipients[]" value="0">
            <div class="btn-secondary fa fa-xmark w-auto"></div>
            <label for="" class=""></label>
        </button>
    </template>

    <div class="form-horizontal">
        <fieldset>
            <div class="form-group">
                <div class="" id="row_user">
                    <input autocomplete="off" type="text"
                        class="d-none form-control auto" id="user" name="user">
                    <div class="searchbar"></div>
                </div>
            </div>
        </fieldset>
        <script type="module">
            createAutocomplete({
                apiPath: () => {
                    return "ac_user"
                },
                placeholder: "{{ trans('app.search') }}",
                searchbarSelector: "#row_user .searchbar",
                noResults: '{{ trans('app.user_not_found') }}',
                type: "list",
                action: "custom",
                selectionFunction: (a, b) => selectedRecipient(a, b),
                inputSelector: "#row_user .auto",
                limit: 5,
                additionalProps: {}
            });
        </script>
    </div>

    <div class="latest-overview">
        @if (count($latestUsers) > 0)
        <div class="fa fa-history w-auto ms-3 me-3"></div>
        @foreach ($latestUsers as $user)
            <div data-userid={{ $user->id }} data-username={{ $user->name }}
                class="btn-group mb-1" data-toggle="buttons">
                <label class="btn btn-secondary d-flex gap-2 align-items-center lh-1">
                    <input class="form-check-input" type="checkbox" autocomplete="off" name="recipients[]"
                        value="{{ $user->id }}"> {{ $user->name }}
                </label>
            </div>
        @endforeach
        @endif
    </div>
</div>
<script type="module">
    setupCheckBoxes(".total-overview");
    setupCheckBoxes(".latest-overview");
</script>