<footer class="text-center">
    <ul class="list-unstyled">
        <li>
            <a href="/">{{ config('app.name') }}</a> {{ config('app.version') }}.{{ \App\Helpers\MiscHelper::get_current_git_commit() }} &copy; 2016-{{ date('Y', time()) }} by rmarchiv.de Team
        </li>
        <li>
            {{ trans('_partials.footer.feedback') }} <a href="mailto:webmaster@rmarchiv.de">webmaster@rmarchiv.de</a>
        </li>
        <li>
            <a href="{{ url('/impressum') }}">{{ trans('_partials.footer.impressum') }}</a>
        </li>
        <li>
            <a href="{{ action('UserController@users_online') }}">{{ trans('_partials.footer.users_online') }} {{ \App\Helpers\DatabaseHelper::getOnlineUserCount()->online }}</a>
        </li>
        @permission(('debug-data'))
        <li>

        </li>
        @endpermission
    </ul>
</footer>