@section('pagetitle', 'zugriff verweigert')
<div class="rmarchivtbl errorbox">
    <h2>{{ trans('app.access_denied.title') }}</h2>
    <div class="content">
        <p>{{ trans('app.access_denied.body') }}</p>
        <br>
        <p>{!! trans('app.access_denied.backtohome') !!}</p>
    </div>
</div>
