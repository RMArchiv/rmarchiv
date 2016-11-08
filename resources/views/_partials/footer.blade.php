<footer>
    <ul>
        <li>
            <a href="/">{{ trans('app.title') }}</a> 0.0.0-pre-alpha1 &copy; 2016-{{ "now"|date('Y') }} <a href="{{ url('/user', 1) }}">ryg</a>
        </li>
        <li>
            feedback und bugs an <a href="mailto:webmaster@rmarchiv.de">webmaster@rmarchiv.de</a>
        </li>
        <li>
            ein blick auf das <a href="{{ url('/changelog') }}">changelog</a> gefällig?
        </li>
        <li>
            <a href="{{ url('/impressum') }}">Impressum</a>
        </li>
    </ul>
</footer>