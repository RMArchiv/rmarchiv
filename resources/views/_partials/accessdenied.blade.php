@section('pagetitle', trans('app.accessdenied'))
<div class="rmarchivtbl errorbox">
    <h2>{{ trans('app.accessdenied') }}</h2>
    <div class="content">
        <p>{{ trans('app.your_permissions_are_to_low') }}</p>
        <br>
        <p>{!! trans('app.back_to_home') !!}</p>
    </div>
</div>
