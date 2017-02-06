<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Khill\Lavacharts\Lavacharts;

class StatsticController extends Controller
{
    public function show() {
        $lava_config = [
            'legend' => [
                'position' => 'in',
                'textStyle' => [
                    'color' => '#ffffe0',
                ],
            ],
            'backgroundColor' => [
                'fill' => '#17395c'
            ],
            'hAxis' => [
                'textStyle' => [
                    'color' => '#ffffe0',
                ],
            ],
            'vAxis' => [
                'textStyle' => [
                    'color' => '#ffffe0',
                ],
            ],
            'pointSize' => 5,
            'pointShape' => [
                'type' => 'circle',
                'rotation' => 180,
            ],
            'trendlines' => [
                0 => [
                    'type' => 'line',
                    'color' => 'red',
                    'pointsVisible'=>true,
                    'pointSize' => 1,
                ],
            ],
        ];

        $lava = new Lavacharts;

        // Anzahl der Registrierungen
        $users = \DB::table('users')
            ->selectRaw('YEAR(created_at) as year')
            ->selectRaw('MONTH(created_at) as month')
            ->selectRaw('COUNT(users.id) AS count')
            ->orderBy('created_at')
            ->groupBy(\DB::raw('YEAR(created_at)'))
            ->groupBy(\DB::raw('MONTH(created_at)'))
            ->get();
        $reg = $lava->DataTable();
        $reg->addStringColumn('Datum')
            ->addNumberColumn('Registrierungen pro Monat');
            foreach ($users as $user) {
                $reg->addRow([$user->year.'-'.$user->month, $user->count]);
            }
        $lava->AreaChart('Registrierungen', $reg, $lava_config);

        // Kommentare pro Monat
        $comments = \DB::table('comments')
            ->selectRaw('YEAR(created_at) as year')
            ->selectRaw('MONTH(created_at) as month')
            ->selectRaw('COUNT(id) AS count')
            ->orderBy('created_at')
            ->groupBy(\DB::raw('YEAR(created_at)'))
            ->groupBy(\DB::raw('MONTH(created_at)'))
            ->get();
        $com = $lava->DataTable();
        $com->addStringColumn('Datum')
            ->addNumberColumn('Kommentare pro Monat');
        foreach ($comments as $comment) {
            $com->addRow([$comment->year.'-'.$comment->month, $comment->count]);
        }
        $lava->AreaChart('Kommentare', $com, $lava_config);

        // Kommentare pro Monat
        $gamesperyear = \DB::table('games_files')
            ->select('release_year as year')
            ->selectRaw('COUNT(release_year) as count')
            ->groupBy('release_year')
            ->orderBy('release_year')
            ->get();
        $com = $lava->DataTable();
        $com->addStringColumn('Datum')
            ->addNumberColumn('Releases pro Jahr');
        foreach ($gamesperyear as $game) {
            $com->addRow([$game->year, $game->count]);
        }
        $lava->AreaChart('Releases', $com, $lava_config);

        // Kommentare pro Monat
        $gamespermonth = \DB::table('games_files')
            ->select('release_month as year')
            ->selectRaw('COUNT(release_month) as count')
            ->groupBy('release_month')
            ->orderBy('release_month')
            ->get();
        $com = $lava->DataTable();
        $com->addStringColumn('Datum')
            ->addNumberColumn('Releases pro Monat');
        foreach ($gamespermonth as $game) {
            $com->addRow([$game->year, $game->count]);
        }
        $lava->AreaChart('ReleasesMon', $com, $lava_config);

        return view('statistics.index', [
            'lava' => $lava,
        ]);

    }
}
