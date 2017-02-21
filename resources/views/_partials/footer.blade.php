<footer>
    <ul>
        <li>
            <a href="/">{{ config('app.name') }}</a> {{ config('app.version') }} &copy; 2016-{{ date('Y', time()) }} by rmarchiv.de Team
        </li>
        <li>
            feedback und bugs an <a href="mailto:webmaster@rmarchiv.de">webmaster@rmarchiv.de</a>
        </li>
        <li>
            <a href="{{ url('/impressum') }}">impressum</a>
        </li>
        <li>
            users online: {{ \App\Helpers\DatabaseHelper::getOnlineUserCount()->online }}
        </li>
        @permission(('debug-data'))
        <li>

        </li>
        @endpermission
    </ul>
</footer>