<footer>
    <ul>
        <li>
            <a href="/">{{ config('app.name') }}</a> {{ config('app.version') }} &copy; 2016-{{ date('Y', time()) }} <a href="{{ url('/users', 1) }}">ryg</a>
        </li>
        <li>
            feedback und bugs an <a href="mailto:webmaster@rmarchiv.de">webmaster@rmarchiv.de</a>
        </li>
        <li>
            <a href="{{ url('/impressum') }}">Impressum</a>
        </li>
    </ul>
</footer>