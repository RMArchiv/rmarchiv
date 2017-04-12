@section('pagetitle', 'zugriff verweigert')
<div class="rmarchivtbl errorbox">
    <h2>{{ trans('_partials.accessdenied.title') }}</h2>
    <div class="content">
        <p>{{ trans('_partials.accessdenied.body') }}</p>
        <br>
        <p>{!! trans('_partials.accessdenied.backtohome') !!}</p>
    </div>
</div>
