<footer class="text-center">
    <ul class="list-unstyled">
        <li>
            <a href="/">{{ config('app.name') }}</a> {{ config('app.version') }}.{{ App::getLocale() }} &copy; 2016-{{ date('Y', time()) }} by RMArchiv Team
        </li>
        <li>
            {{ trans('app.feedback_for_features_or_bugs') }} <a href="mailto:webmaster@rmarchiv.de">webmaster@rmarchiv.de</a>
        </li>
        <li>
            <a href="{{ url('/impressum') }}">{{ trans('app.imprint') }}</a> - <a href="{{ url('/datenschutz') }}">Datenschutzerklärung</a>
        </li>
        <li>
            <a href="{{ action('UserController@users_online') }}">{{ trans('app.users_online') }}: {{ \App\Helpers\DatabaseHelper::getOnlineUserCount()->online }}</a>
        </li>
        @permission(('debug-data'))
        <li>

        </li>
        @endpermission
    </ul>
</footer>