<body>
Script is: {{ $onoff }}<br>
<a href="{{ action('TestController@on') }}">on</a> - <a href="{{ action('TestController@off') }}">off</a>
</body>