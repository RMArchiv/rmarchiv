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
        'show'  => [
            'submit_by'  => 'Eingesendet von',
            'at'         => 'at',
            'delete'     => 'löschen',
            'approve'    => 'erlauben',
            'disapprove' => 'sperren',
        ],
        'popularity_helper' => [
            'title' => 'popularitäts helfer',
            'msg'   => 'erhöhe den bekanntheitsgrad dieser news und verteile folgenden link:',
        ],
        'comments' => [
            'title'             => 'kommentare',
            'title_add'         => 'kommentar hinzufügen',
            'no_comments_title' => 'es sind noch keine kommentare vorhanden.',
            'no_comments_msg'   => 'wip',
            'vote_title'        => 'hier kannst du diese news bewerten:',
            'vote_sub'          => 'diese news',
            'vote_down'         => 'ist scheiße',
            'vote_neut'         => 'ist ok',
            'vote_up'           => 'ist super',
            'success'           => [
                'title'    => 'kommentar erfolgreich hinzugefügt',
                'msg'      => 'dein kommentar wurde erfolgreich hinzugefügt.',
                'redirect' => 'zurück zum inhalt...',
            ],
        ],
        'add' => [
            'title' => 'news hinzufügen',
            'error' => [
                'title' => 'news konnte nicht hinzugefügt werden.',
            ],
        ],
    ],

    'games' => [
        'title' => 'spiele',

        'index' => [
        ],

        'gamefiles' => [
            'title'           => 'dateien zum spiel',
            'type'            => 'typ',
            'version'         => 'version',
            'release_date'    => 'veröffentlicht',
            'filesize'        => 'dateigröße',
            'downloads'       => 'downloads',
            'uploaded_by'     => 'hochgeladen von',
            'uploaded_at'     => 'hochgeladen am',
            'actions'         => 'aktionen',
            'no_files'        => 'es sind noch keine dateien zu diesem spiel verfügbar.',
            'add_file'        => 'hinzufügen einer spieledatei',
            'filetype'        => 'dateityp:',
            'filetype_choose' => 'bitte wähle einen dateityp',
            'version2'        => 'version:',
            'release_date2'   => 'veröffentlicht am:',
            'month'           => 'monat',
            'year'            => 'jahr',
            'day'             => 'tag',
        ],
        'add' => [
            'title'             => 'anlegen eines neuen spiels',
            'gametitle'         => 'spieltitel:',
            'subtitle'          => 'untertitel:',
            'maker'             => 'erstellt mit:',
            'maker_choose'      => 'bitte verwendeten maker wählen',
            'language'          => 'spielsprache:',
            'langauge_choose'   => 'bitte spielsprache wählen',
            'description_title' => 'beschreibungstext ändern/hinzufügen',
            'description_help'  => 'beschreibung des spiels (max. 2000 zeichen)',
            'description'       => 'beschreibung:',
            'links'             => 'links',
            'website'           => 'website:',
            'connections'       => 'verbindungen',
            'developer'         => 'entwickler name:',
            'developer_help'    => 'hier bitte nur den Hauptentwickler angeben. weitere entwickler können später hinzugefügt werden.',
            'success'           => [
                'title'    => 'spiel hinzugefügt',
                'msg'      => 'das spiel wurde erfolgreich hinzugefügt. du kannst dir das profil auf der folgenden seite anschauen und erweitern.',
                'redirect' => 'weiter zum spiel...',
            ],
        ],
        'edit' => [
            'title'          => 'bearbeiten eines spiels',
            'developer'      => 'verbundene entwickler',
            'developer_add'  => 'entwickler zum spiel hinzufügen',
            'developer_help' => 'einfach entwicklernamen eintippen',
        ],
    ],

    'resources' => [
        'title' => 'ressourcen',
    ],

    'developer' => [
        'title' => 'entwickler',
    ],

    'awards' => [
        'title' => 'auszeichnungen',
    ],

    'user' => [
        'title'    => 'user',
        'settings' => [
            'title' => 'einstellungen',
        ],
        'user_level' => [
            'admin'     => 'obyxstrator',
            'moderator' => 'moderobyx',
            'user'      => 'ungläubiger',
        ],
    ],

    'search' => [
        'title' => 'suche',
    ],

    'board' => [
        'title' => 'forum',
    ],

    'faq' => [
        'title' => 'faq',
    ],

    'submit' => [
        'title' => 'einsenden',
        'logo'  => [
            'title'  => 'upload eines neuen website logos',
            'name'   => 'name des logos:',
            'file'   => 'wähle logo datei:',
            'submit' => 'logo hochladen',
            'error'  => [
                'title' => 'logo upload fehlgeschlagen',
            ],
            'success' => [
                'title'    => 'logo upload erfolgreich abgeschlossen',
                'msg'      => 'dein logo wurde erfolgreich hochgeladen. <br> nun kannst du auf folgender seite dafür abstimmen.',
                'redirect' => 'weiter zum logo voting...',
            ],
        ],
    ],

    'auth' => [
        'login'            => 'login',
        'register'         => 'registrieren',
        'password_reset'   => 'passwort vergessen?',
        'remember_me'      => 'login merken',
        'email'            => 'e-mail adresse:',
        'password'         => 'passwort:',
        'login_failed'     => 'login fehlgeschlagen',
        'register_failed'  => 'registrierung fehlgeschlagen',
        'username'         => 'benutzername:',
        'password_confirm' => 'passwort wiederholen:',
        'loggedin_as'      => 'du bist eingeloggt als',
        'logout'           => 'logout',
        'register_title'   => 'registrierung / anmeldedaten',
    ],

    'errors' => [
        'submit' => [
            'no_login' => [
                'title'   => 'du bist nicht angemeldet.',
                'message' => '
<ul>
    <li>um inhalte auf :websitetitle hinzufügen zu können, musst du dich <a href=":loginurl">anmelden</a>.</li>
    <li>wenn du noch keinen accounts besitzt, <a href=":registerurl">registriere</a> dir einen neuen.</li>
</ul>',
            ],

        ],
    ],

    'comments' => [
        'tip1' => 'Der erste Kommentar bei dem du eine Bewertung auswählst, ist auch gleichzeitig die letzte Bewertung für dieses Spiel/News/Ressource. Also wähle mit bedacht.',
        'tip2' => 'Kommentieren kann man auch ohne Bewertung. Dafür wählte einfach "ist ok". ',
        'tip3' => 'Sei nett. Nur weil das Spiel/News/Ressource scheiße ist, sollte man es trotzdem nicht schreiben. Es sei denn man begründet es vernünftig.',
        'tip4' => 'Kommentiert ihr wie Ärsche, dann werdet ihr so behandelt. Also abgewischt und ab in die Banntoilette.',
    ],

    'misc' => [
        'send'          => 'senden',
        'delete'        => 'löschen',
        'download'      => 'download',
        'nothing_found' => 'es wurde nichts gefunden',
        'upload_file'   => 'datei hochladen',
        'month'         => [
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
    ],
];
