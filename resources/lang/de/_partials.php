<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

return [
    'accessdenied' => [
        'title'      => 'zugriff verweigert!',
        'body'       => 'du hast nicht die erforderlichen berechtigungen um diese seite zu sehen.',
        'backtohome' => 'zurück zur <a href="' . url('/') . '">hauptseite</a>',
    ],
    'banned'       => [
        'title' => 'du wurdest gebannt!',
        'line1' => 'du bist einer der wenigen user, die es geschafft haben sich bannen zu lassen.',
        'line2' => 'welch eine herausragende leistung.',
        'line3' => 'nun wurdest du zu einem zuschauer degradiert, der nicht mehr mit unserer community interagieren darf.',
        'line4' => 'solltest du dich ungerecht behandelt fühlen, schreibe einem moderator oder administrator eine pn.',
        'greet' => 'hochachtungsvoll,',
        'team'  => 'dein rmarchiv.de team',
    ],

    'footer' => [
        'feedback'     => 'feedback und bugs an:',
        'impressum'    => 'impressum',
        'users_online' => 'benutzer online:',
    ],

    'inline_gamebox' => [
        'titlescreen' => 'titelbild',
        'developer'   => 'entwickler',
    ],

    'tables' => [
        'game_table'      => [

        ],
        'game_table_head' => [
            'title' => 'titel',
            'developer' => 'entwickler',
            'release_date' => 'erschienen am',
            'created_at' => 'erstellt am',
            'rate_up' => 'super',
            'rate_down' => 'scheiße',
            'avg' => 'avg',
            'popularity' => 'popularität',
            'comments' => 'kommentare'
        ],
        'game_table_row'  => [

        ],
    ],
];
