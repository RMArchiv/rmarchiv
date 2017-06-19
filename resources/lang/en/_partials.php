<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

return [
    'accessdenied' => [
        'title'      => 'Permission denied!',
        'body'       => 'You do not have sufficient permissions for this page.',
        'backtohome' => 'Back to <a href="' . url('/') . '">Home</a>',
    ],
    'banned'       => [
        'title' => 'You are banned!',
        'line1' => 'Du bist einer der wenigen User, die es geschafft haben sich bannen zu lassen.',
        'line2' => 'Welch eine herausragende Leistung.',
        'line3' => 'Nun wurdest du zu einem Zuschauer degradiert, der nicht mehr mit unserer Community interagieren darf.',
        'line4' => 'Solltest du dich ungerecht behandelt fühlen, schreibe einem Moderator oder Aministrator eine PN.',
        'greet' => 'Hochachtungsvoll,',
        'team'  => 'dein rmarchiv.de Team',
    ],

    'footer' => [
        'feedback'     => 'Feedback and Bugs to:',
        'impressum'    => 'Imprint',
        'users_online' => 'User online:',
    ],

    'inline_gamebox' => [
        'titlescreen' => 'Titlescreen',
        'developer'   => 'Developer',
    ],

    'tables' => [
        'game_table'      => [

        ],
        'game_table_head' => [
            'title'        => 'Title',
            'developer'    => 'Developer',
            'release_date' => 'Released at',
            'created_at'   => 'Added at',
            'rate_up'      => 'great',
            'rate_down'    => 'garbage',
            'avg'          => 'avg',
            'popularity'   => 'Popularity',
            'comments'     => 'Comments',
        ],
        'game_table_row'  => [

        ],
    ],
];
