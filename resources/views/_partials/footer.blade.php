<footer class="text-center">
    <ul class="list-unstyled">
        <li>
            @php
                $url_array = explode('.', parse_url($request->url(), PHP_URL_HOST));
                $subdomain = $url_array[0];
            @endphp
            <a href="/">{{ config('app.name') }}</a> {{ config('app.version') }}.{{ $subdomain }} &copy; 2016-{{ date('Y', time()) }} by rmarchiv.de Team
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