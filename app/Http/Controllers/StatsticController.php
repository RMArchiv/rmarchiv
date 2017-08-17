<?php

/*
 * rmarchiv.tk
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Http\Controllers;

use App\Models\Maker;
use Khill\Lavacharts\Lavacharts;

class StatsticController extends Controller
{
    public function show()
    {
        $lava_config = [
            'legend' => [
                'position' => 'in',
                'textStyle' => [
                    'color' => '#ffffe0',
                ],
            ],
            'backgroundColor' => [
                'fill' => '#002B36',
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
                    'pointsVisible' => true,
                    'pointSize' => 1,
                ],
            ],
        ];

        $lava = new Lavacharts();

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

        //Forenposts pro Monat
        // Kommentare pro Monat
        $postspermonth = \DB::table('board_posts')
            ->selectRaw('YEAR(created_at) as year')
            ->selectRaw('MONTH(created_at) as month')
            ->selectRaw('COUNT(id) AS count')
            ->orderBy('created_at')
            ->groupBy(\DB::raw('YEAR(created_at)'))
            ->groupBy(\DB::raw('MONTH(created_at)'))
            ->get();
        $com = $lava->DataTable();
        $com->addStringColumn('Datum')
            ->addNumberColumn('Forenposts pro Monat');
        foreach ($postspermonth as $p) {
            $com->addRow([$p->year.'-'.$p->month, $p->count]);
        }
        $lava->AreaChart('ForumPosts', $com, $lava_config);

        $filesize = [
            'attach' => [
                'size' => 0,
                'count' => 0,
            ],
            'screens' => [
                'size' => 0,
                'count' => 0,
            ],
            'games' => [
                'size' => 0,
                'count' => 0,
            ],
            'logos' => [
                'size' => 0,
                'count' => 0,
            ],
            'resources' => [
                'size' => 0,
                'count' => 0,
            ],
            'sum' => [
                'size' => 0,
                'count' => 0,
            ],
        ];

        $files = \Storage::files('attachments');
        foreach ($files as $f) {
            $filesize['attach']['size'] += \Storage::size($f);
        }
        $filesize['attach']['count'] = count($files);
        $filesize['sum']['size'] += $filesize['attach']['size'];
        $filesize['sum']['count'] += $filesize['attach']['count'];

        $files = \Storage::files('screenshots');
        foreach ($files as $f) {
            $filesize['screens']['size'] += \Storage::size($f);
        }
        $filesize['screens']['count'] = count($files);
        $filesize['sum']['size'] += $filesize['screens']['size'];
        $filesize['sum']['count'] += $filesize['screens']['count'];

        $files = \Storage::files('games');
        foreach ($files as $f) {
            $filesize['games']['size'] += \Storage::size($f);
        }
        $filesize['games']['count'] = count($files);
        $filesize['sum']['size'] += $filesize['games']['size'];
        $filesize['sum']['count'] += $filesize['games']['count'];

        $files = \Storage::files('logos');
        foreach ($files as $f) {
            $filesize['logos']['size'] += \Storage::size($f);
        }
        $filesize['logos']['count'] = count($files);
        $filesize['sum']['size'] += $filesize['logos']['size'];
        $filesize['sum']['count'] += $filesize['logos']['count'];

        $files = \Storage::files('resources');
        foreach ($files as $f) {
            $filesize['resources']['size'] += \Storage::size($f);
        }
        $filesize['resources']['count'] = count($files);
        $filesize['sum']['size'] += $filesize['resources']['size'];
        $filesize['sum']['count'] += $filesize['resources']['count'];

        // Augeteilt nach Maker
        $makerchart = Maker::all();
        $com = $lava->DataTable();
        $com->addStringColumn('Maker')
            ->addNumberColumn('Spieleanzahl');
        foreach ($makerchart as $maker) {
            $com->addRow([$maker->title, $maker->games->count()]);
        }
        $lava->PieChart('MakerChart', $com, $lava_config);

        // Kelven Stats...
        $gamesperyear = \DB::table('games_files')
            ->leftJoin('games_developer', 'games_developer.game_id', '=', 'games_files.game_id')
            ->select('games_files.release_year as year')
            ->selectRaw('COUNT(games_files.release_year) as count')
            ->where('games_developer.developer_id', '=', 6)
            ->groupBy('games_files.release_year')
            ->orderBy('games_files.release_year')
            ->get();
        $com = $lava->DataTable();
        $com->addStringColumn('Datum')
            ->addNumberColumn('Releases pro Jahr');
        foreach ($gamesperyear as $game) {
            $com->addRow([$game->year, $game->count]);
        }
        $lava->AreaChart('PlayerReleases', $com, $lava_config);

        return view('statistics.index', [
            'lava' => $lava,
            'files' => $filesize,
        ]);
    }
}
