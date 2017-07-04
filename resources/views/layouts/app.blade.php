<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="de">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="Marcel 'ryg' Hering" />

    <title>
        @yield('pagetitle')
        :: rmarchiv.de :: your online rpgmaker resource</title>

    <?= Meta::tag('robots'); ?>

    <?= Meta::tag('site_name', 'rmarchiv.de'); ?>
    <?= Meta::tag('url', Request::url()); ?>
    <?= Meta::tag('locale', 'de_DE'); ?>

    <?= Meta::tag('title'); ?>
    <?= Meta::tag('description'); ?>

    <?= Meta::tag('image'); ?>
    <title>
        @yield('pagetitle')
    </title>

    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon"/>
    <link rel="canonical" href="http://www.rmarchiv.de/"/>

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
@include('_partials.banned')

@if(Route::currentRouteName() == 'home')
    @yield('content')
@else
    <div class="col-md-12">
        @yield('content')
    </div>
@endif


{{-- @include('_partials.navigation', ['part' => 'bottompart']) --}}
@include('_partials.footer')

@include('cookieConsent::index')

</body>

<!--[if lt IE 9]><script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script><![endif]-->
<!--[if IE]><script src="http:////html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</html>