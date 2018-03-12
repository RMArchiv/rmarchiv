<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="de">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="Marcel 'ryg' Hering" />

    <title>
        @yield('pagetitle')
        :: rmarchiv.tk :: your online rpgmaker resource</title>

    <?= Meta::tag('robots'); ?>

    <?= Meta::tag('site_name', 'rmarchiv.tk'); ?>
    <?= Meta::tag('url', Request::url()); ?>
    <?= Meta::tag('locale', 'de_DE'); ?>

    <?= Meta::tag('title'); ?>
    <?= Meta::tag('description'); ?>

    <?= Meta::tag('image'); ?>
    <title>
        @yield('pagetitle')
    </title>

    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon"/>
    <link rel="canonical" href="http://www.rmarchiv.tk/"/>

    <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ elixir('css/app.css') }}" media="screen" />

    <script src="{{ elixir('js/all.js') }}"></script>

    <script type="text/javascript">
        <!--
        var pixelWidth = screen.width;
        var rmarchiv = {};
        rmarchiv.isMobile = false;
        //-->
    </script>
</head>
<body>
@php
    \App\Helpers\DatabaseHelper::setOnline(Request::url());
@endphp

{{--  @include('_partials.header') --}}
@include('_partials.navigation', ['part' => 'toppart'])

@if(Auth::check())
    @if(Auth::user()->isBanned())
        <div class="col-md-12 mt-3">
            <div class="container">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            Du wurdest gebannt.
                        </div>
                        <div class="card-body">
                            <p>Der Grund für den Bann:</p>
                            <p>{{ Auth::user()->bans()->latest()->first()->comment }}</p>
                        </div>
                        <div class="card-footer">
                            Automatisches entsperren am: {{ Auth::user()->bans()->latest()->first()->expired_at }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        @if(Route::currentRouteName() == 'home')
            @yield('content')
        @else
            <div class="col-md-12 mt-3">
                @yield('content')
            </div>
        @endif
    @endif
@else
    @if(Route::currentRouteName() == 'home')
        @yield('content')
    @else
        <div class="col-md-12 mt-3">
            @yield('content')
        </div>
    @endif
@endif


{{-- @include('_partials.navigation', ['part' => 'bottompart']) --}}
@include('_partials.footer')

@include('cookieConsent::index')

</body>

<!--[if lt IE 9]><script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script><![endif]-->
<!--[if IE]><script src="http:////html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

<!-- Matomo -->
<script type="text/javascript">
    var _paq = _paq || [];
    /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
    @if(Auth::check())
        _paq.push(['setUserId', '{{ Auth::user()->id }}'])
    @endif
    _paq.push(['trackPageView']);
    _paq.push(['enableLinkTracking']);
    (function() {
        var u="//stats.rmarchiv.tk/";
        _paq.push(['setTrackerUrl', u+'piwik.php']);
        _paq.push(['setSiteId', '1']);
        var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
        g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
    })();
</script>
<!-- End Matomo Code -->
</html>