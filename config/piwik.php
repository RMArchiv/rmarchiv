<?php

/*
 * rmarchiv.tk
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

return [

    /*
     *  Server URL
     */

    'piwik_url'     => 'https://stats.rmarchiv.tk',

    /*
     *  Piwik Username and Password
     */

    'username'      => 'ryg',
    'password'      => 'Skymaster2',

    /*
     *  Optional API Key (will be used instead of Username and Password)
     *  The bundle works much faster with the API Key, rather than username and password.
     */

    'api_key'       => 'd5a5fb7267299f00e13b9878b8e3360e',

    /*
     *  Format for API calls to be returned in
     *
     *  Can be [php, xml, json, html, rss, original]
     *
     *  The default is 'json'
     */

    'format'        => 'json',

    /*
     *  Period/Date range for results
     *
     *  Can be [today, yesterday, previous7, previous30, last7, last30, currentweek, currentmonth, currentyear] as well as a date range in the format of "yyyy-MM-dd,yyyy-MM-dd"
     *
     *  The default is 'yesterday'
     */

    'period'        => 'yesterday',

    /*
     *  The Site ID you want to use
     */

    'site_id'       => '1',
];
