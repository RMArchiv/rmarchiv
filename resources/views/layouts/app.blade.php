<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="de">
<head>
    <title>
        rmarchiv.de :: your online rpgmaker resource
    </title>

    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon"/>
    <link rel="canonical" href="http://www.rmarchiv.de/"/>

    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ url('css/app.css') }}" media="screen" />


    <script type="text/javascript">
        <!--
        var pixelWidth = screen.width;
        var rmarchiv = {};
        rmarchiv.isMobile = false;
        //-->
    </script>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="description" content="rmarchiv.de - your online rpgmaker resource"/>
    <meta name="keywords" content="quartier,rpg maker,rpgmaker,rmvx,rm2k,rm2k3"/>
    <meta charset="utf-8"/>
</head>
<body>

@include('_partials.header')
@include('_partials.navigation', ['part' => 'toppart'])

@yield('content')

@include('_partials.navigation', ['part' => 'bottompart'])
@include('_partials.footer')

<script type="text/javascript">
    <!--
    document.observe("dom:loaded", function() {
        if (rmarchiv.isMobile) {
            CollapsibleHeaders($$(".rmarchivtbl"));
        }
    });
    //-->
</script>
</body>

<!--[if lt IE 9]><script src="//ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script><![endif]-->
<!--[if IE]><script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</html>