<?php

return array(

    /*
     *  Server URL
     */

    'piwik_url'     => 'https://stats.rmarchiv.de',

    /*
     *  Piwik Username and Password
     */

    'username'      => '',
    'password'      => '',

    /*
     *  Optional API Key (will be used instead of Username and Password) 
     *  The bundle works much faster with the API Key, rather than username and password.
     */

    'api_key'       =>  'c4dfcb6ba19dae920e2017bb275a4862',

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
);