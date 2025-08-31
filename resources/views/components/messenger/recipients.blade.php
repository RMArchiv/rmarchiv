<div class="recipient-section">

    {{-- recipient list --}}
    <div class="input-group mb-2">
        <label for="select"
            class="input-group-text">{{ trans('app.recipients') }}*</label>
        <div id="recipient-list" class="form-control d-flex gap-1 flex-wrap ">
        </div>

    </div>
    {{-- template for recipient button --}}
    <template>
        <button data-userid="0" data-username=""
            class="btn-group btn btn-secondary d-flex flex-shrink gap-2 align-items-center"
            data-toggle="buttons">
            <input id="" class="d-none" type="checkbox" autocomplete="off"
                name="recipients[]" value="0">
            <div class="btn-secondary fa fa-xmark w-auto"></div>
            <label for="" class="">
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
        <div class="fa fa-users w-auto ms-3 me-3"></div>
        @foreach ($latestUsers as $user)
            <div data-userid={{ $user->id }} data-username={{ $user->name }}
                class="btn-group mb-1" data-toggle="buttons">
                <label class="btn btn-secondary d-flex gap-2 align-items-center lh-1">
                    <input type="checkbox" autocomplete="off" name="recipients[]"
                        value="{{ $user->id }}"> {{ $user->name }}
                </label>
            </div>
        @endforeach


        <p class="d-inline-flex gap-1">
            <button class="btn btn-primary" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseExample" aria-expanded="false"
                aria-controls="collapseExample">
                <div class="lh-1">{{ trans('app.more') . '...' }}</div>
            </button>
        </p>
        <div class="collapse" id="collapseExample">
            <div class="card card-body">
                <div class="total-overview-container d-flex flex-column gap-2">
                    <input class="form-control" placeholder={{ trans('app.search') }}
                        id="filterBoxes" oninput="filterInput(event)">
                    <div class="total-overview d-flex flex-wrap">
                        @foreach ($users as $user)
                            <div data-userid={{ $user->id }}
                                data-username={{ $user->name }}
                                class="btn-group d-grid mb-1 me-1"
                                data-toggle="buttons">
                                <label
                                    class="btn btn-secondary d-flex gap-2 align-items-center lh-1 hyphens">
                                    <input type="checkbox" autocomplete="off"
                                        name="recipients[]"
                                        value="{{ $user->id }}">
                                    {{ $user->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>






    </div>
</div>
<script type="module">
    setupCheckBoxes(".total-overview");
    setupCheckBoxes(".latest-overview");
</script>