<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

return [
    'home' => [
        'title' => 'home',
    ],

    'news' => [
        'title' => 'news',
    ],

    'games' => [
        'title'          => 'spiele',
        'title_single'   => 'spiel',
        'table'          => [
            'title'        => 'spielname',
            'developer'    => 'entwickler',
            'release_date' => 'release datum',
            'created_at'   => 'hinzugefügt',
            'rate_up'      => 'super',
            'rate_down'    => 'scheiße',
            'rate_neut'    => 'neutral',
            'avg'          => 'avg', //average rating
            'popularity'   => 'popularität',
            'comments'     => 'kommentare',
        ],
        'inline_gamebox' => [
            'titlescreen' => 'titelbild',
            'developer'   => 'entwickler',
        ],
    ],

    'resources' => [
        'title' => 'ressourcen',
    ],

    'developer' => [
        'title'        => 'entwickler',
        'title_single' => 'entwickler',
    ],

    'maker' => [
        'title' => 'maker',
    ],

    'awards' => [
        'title'        => 'auszeichnungen',
        'title_single' => 'auszeichnung',
        'nav'          => [
            'overview' => 'übersicht',
            'add'      => 'award hinzufügen',
        ],
        'create'       => [
            'website'  => [
                'title'            => 'auszeichnungswebsite hinzufügen',
                'website'          => 'website:',
                'website_info'     => 'wenn gefunden, dann existiert sie schon.',
                'website_notfound' => 'gut, die website wurde nicht gefunden.',
                'url'              => 'url (mit http/s)',
                'send'             => 'senden',
            ],
            'award'    => [
                'title'         => 'auszeichnung hinzufügen',
                'website'       => 'auszeichnungswebsite',
                'please_choose' => 'bitte website auswählen',
                'name'          => 'name:',
                'not_found'     => 'keine auszeichnung gefunden',
                'date'          => 'auszeichnungsdatum',
                'month_info'    => 'monat optional',
                'send'          => 'senden',
            ],
            'category' => [
                'title'         => 'auszeichnungskategorie hinzufügen',
                'award'         => 'auszeichnung',
                'please_choose' => 'bitte award auswählen',
                'name'          => 'kategorie name:',
                'send'          => 'senden',
            ],
        ],
        'add_game'     => [
            'title'       => 'spiel zu auszeichnung hinzufügen',
            'gametitle'   => 'spieltitel:',
            'not_found'   => 'das spiel wurde nicht gefunden.',
            'place'       => 'platzierung:',
            'description' => 'beschreibung:',
            'send'        => 'senden',
        ],
        'show'         => [
            'add_game' => 'spiel hinzufügen',
            'place'    => 'platz',
        ],
    ],

    'user' => [
        'title'        => 'benutzer',
        'title_single' => 'benutzer',
    ],

    'search' => [
        'title' => 'suche',
    ],

    'board' => [
        'title' => 'forum',
        'index' => [
            'title'           => 'das rmarchiv forum',
            'create'          => 'erstelle einen neuen thread',
            'create_title'    => 'threadtitel:',
            'create_category' => 'forenkategorie:',
            'message'         => 'nachricht:',
            'send'            => 'senden',
        ],
        'table' => [
            'create_date'   => 'geöffnet',
            'firstpostuser' => 'von',
            'category'      => 'kategorie',
            'topic'         => 'thema',
            'postcount'     => 'antworten',
            'lastpostdate'  => 'letzter post',
            'lastpostuser'  => 'von',
        ],
        'no_login' => [
            'title' => 'du bist nicht angemeldet',
            'msg' => '
            du bist nicht angemeldet.<br>
            um einen thread erstellen zu können, <a href="'.url('login').'">logge</a> dich ein.<br>
            wenn du keinen account hast, <a href="'.url('register').'">registriere</a> dich doch einfach.
            ',
        ],
    ],

    'faq' => [
        'title' => 'faq',
    ],

    'submit' => [
        'title' => 'einsenden',
    ],

    'cdc' => [
        'title' => 'coup de coeur',
    ],

    'messages' => [
        'new_msg' => 'neue nachricht(en)',
        'widget'  => [

        ],
    ],

    'languages' => [
        'de'        => 'deutsch',
        'de_boring' => 'Deutsch',
        'en'        => 'english',
    ],

    'access_denied' => [
        'title'      => 'zugriff verweigert!',
        'body'       => 'du hast nicht die erforderlichen berechtigungen um diese seite zu sehen.',
        'backtohome' => 'zurück zur <a href="'.url('/').'">hauptseite</a>',
    ],

    'footer' => [
        'feedback'     => 'feedback und bugs an:',
        'impressum'    => 'impressum',
        'users_online' => 'benutzer online:',
    ],

    'misc' => [
        'send'  => 'senden',
        'dates' => [
            'month' => [
                'title' => 'monat',
                'long'  => [
                    1  => 'januar',
                    2  => 'februar',
                    3  => 'märz',
                    4  => 'april',
                    5  => 'mai',
                    6  => 'juni',
                    7  => 'juli',
                    8  => 'august',
                    9  => 'september',
                    10 => 'oktober',
                    11 => 'november',
                    12 => 'dezember',
                ],
                'short' => [
                    1  => 'jan',
                    2  => 'feb',
                    3  => 'mär',
                    4  => 'apr',
                    5  => 'mai',
                    6  => 'jun',
                    7  => 'jul',
                    8  => 'aug',
                    9  => 'sep',
                    10 => 'okt',
                    11 => 'nov',
                    12 => 'dez',
                ],
            ],
            'year'  => [
                'title' => 'jahr',
            ],
        ],
    ],
];
