<?php

return [
    'home' => [
        'title' => 'home',
    ],

    'news' => [
        'title' => 'news',
        'add' => [
            'title' => 'news hinzufügen',

            'error' => [
                'title' => 'news konnte nicht hinzugefügt werden.',
            ],
        ],
    ],

    'games' => [
        'title' => 'spiele',
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
        'title' => 'user',
        'settings' => [
            'title' =>'einstellungen',
        ],
        'user_level' => [
            'admin' => 'obyxstrator',
            'moderator' => 'moderobyx',
            'user' => 'ungläubiger',
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
        'logo' => [
            'title' => 'upload eines neuen website logos',
            'name' => 'name des logos:',
            'file' => 'wähle logo datei:',
            'submit' => 'logo hochladen',
            'error' => [
                'title' => 'logo upload fehlgeschlagen',
            ],
            'success' => [
                'title' => 'logo upload erfolgreich abgeschlossen',
                'msg' => 'dein logo wurde erfolgreich hochgeladen. <br> nun kannst du auf folgender seite dafür abstimmen.',
                'redirect' => 'weiter zum logo voting...'
            ],
        ],
    ],

    'auth' => [
        'login' => 'login',
        'register' => 'registrieren',
        'password_reset' => 'passwort vergessen?',
        'remember_me' => 'login merken',
        'email' => 'e-mail adresse:',
        'password' => 'passwort:',
        'login_failed' => 'login fehlgeschlagen',
        'register_failed' => 'registrierung fehlgeschlagen',
        'username' => 'benutzername:',
        'password_confirm' => 'passwort wiederholen:',
        'loggedin_as' => 'du bist eingeloggt als',
        'logout' => 'logout',
        'register_title' => 'registrierung / anmeldedaten',
    ],

    'errors' => [
        'submit' => [
            'no_login' => [
                'title' => 'du bist nicht angemeldet.',
                'message' => '
<ul>
    <li>um inhalte auf :websitetitle hinzufügen zu können, musst du dich <a href=":loginurl">anmelden</a>.</li>
    <li>wenn du noch keinen accounts besitzt, <a href=":registerurl">registriere</a> dir einen neuen.</li>
</ul>',
            ],

        ],
    ],
];