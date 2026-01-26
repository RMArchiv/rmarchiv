<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Http\Controllers;

use App\Models\Maker;

class StatisticsController extends Controller
{
    public function show()
    {
        // games per year
        $gamesperyear = \DB::table('games_files')
            ->select('release_year as year')
            ->selectRaw('COUNT(release_year) as count')
            ->groupBy('release_year')
            ->orderBy('release_year')
            ->get();
        $releasesYear = array( array(), array());
        array_push($releasesYear[0], trans("app.date"));
        array_push($releasesYear[0], trans('app.releases_per_year'));
        foreach ($gamesperyear as $game) {
            array_push($releasesYear[1], [$game->year, $game->count]);
        }

        // Kelven games
        $kelven = \DB::table('games_files')
            ->leftJoin('games_developer', 'games_developer.game_id', '=', 'games_files.game_id')
            ->select('games_files.release_year as year')
            ->selectRaw('COUNT(games_files.release_year) as count')
            ->where('games_developer.developer_id', '=', 6)
            ->groupBy('games_files.release_year')
            ->orderBy('games_files.release_year')
            ->get();

        // releases per maker
        $makerchart = Maker::all();
        $makerReleases = array();
        $makerNames = array();
        $makerCount = array();
        foreach ($makerchart as $maker) {
            array_push($makerNames, $maker->title);
            array_push($makerCount, $maker->games->count());
        }
        array_push($makerReleases, $makerNames);
        array_push($makerReleases, $makerCount);


        $filesize = [
            'attach' => [
                'size'  => 0,
                'count' => 0,
            ],
            'screens' => [
                'size'  => 0,
                'count' => 0,
            ],
            'games' => [
                'size'  => 0,
                'count' => 0,
            ],
            'logos' => [
                'size'  => 0,
                'count' => 0,
            ],
            'resources' => [
                'size'  => 0,
                'count' => 0,
            ],
            'sum' => [
                'size'  => 0,
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

        $g1995 = $this->releasePerMakerInYear(1);
        $gxp = $this->releasePerMakerInYear(4);
        $gvx = $this->releasePerMakerInYear(5);
        $gmv = $this->releasePerMakerInYear(6);
        $gvxace = $this->releasePerMakerInYear(7);
        $g2k3steam = $this->releasePerMakerInYear(9);
        $g2ksteam = $this->releasePerMakerInYear(11);
        $g2000 = $this->releasePerMakerInYear(2);
        $g2003 = $this->releasePerMakerInYear(3);
        $gmz = $this->releasePerMakerInYear(15);

        $this->catMakerCollection($g2003,$g2k3steam);
        $this->catMakerCollection($g2000,$g2ksteam);

        // Fill zero counting entries for missing years of each maker list
        $range = $this->getYearRange();
        $this->fillYears($g1995, $range);
        $this->fillYears($g2000, $range);
        $this->fillYears($g2003, $range);
        $this->fillYears($gxp, $range);
        $this->fillYears($gvx, $range);
        $this->fillYears($gmv, $range);
        $this->fillYears($gvxace, $range);
        $this->fillYears($gmz, $range);

        return view('statistics.index', [
            'releasesYear'  => $releasesYear,
            'files' => $filesize,
            'releasesYearKelven' => $kelven->toArray(),
            'makerReleases' => $makerReleases,
            'makerPerYear' => array(
                '1995'=>$g1995,
                '2000'=>$g2000,
                '2003'=>$g2003,
                'xp'=>$gxp,
                'vx'=>$gvx,
                'vxace'=>$gvxace,
                'mv'=>$gmv,
                'mz'=>$gmz,
            )
        ]);
    }
    public function releasePerMakerInYear($makerId) {
        return \DB::table('games_files')
            ->leftJoin('games', 'games.id', '=', 'games_files.game_id')
            ->leftJoin('makers', 'makers.id', '=', 'maker_id')
            ->select(['games_files.release_year as year', 'games.maker_id as maker_id',"makers.title"])
            ->where('games.maker_id','=', $makerId)
            ->selectRaw('COUNT(games_files.release_year) as count')
            ->groupBy('games_files.release_year')
            ->orderBy('games_files.release_year')
            ->get();
    }

    // return maximum and minimum year
    public function getYearRange() {
        $extremes = \DB::table('games_files')
            ->selectRaw('MAX(games_files.release_year) as new, MIN(games_files.release_year) as old')
            ->get(0)->toArray()[0];
        return (range($extremes->old, $extremes->new));
    }

    // fill missing years with count 0
    public function fillYears(\Illuminate\Support\Collection &$list, Array $range) {
        foreach ($range as $key => $value) {
            if(!($list->filter(fn (\StdClass $item) => $item->year === $value)->count() > 0)){
                $something = new \StdClass();
                $something->year = $value;
                $something->maker_id = $list->random()->maker_id;
                $something->title = $list->random()->title;
                $something->count = 0;
                $list->push($something);
            }
        }
        $list = $list->sort(function(\StdClass $itemA, $itemB) {
            if($itemA->year > $itemB->year) {return 1;}
            else if($itemA->year < $itemB->year) {return -1;}
            else {return 0;}
        })->values();
    }

    // fill missing years with count 0
    public function catMakerCollection(\Illuminate\Support\Collection &$recipient, \Illuminate\Support\Collection &$extra) {
        foreach ($extra as $item) {
            foreach ($recipient as $game) {
                if($item->year == $game->year) {
                    $game->count += $item->count;
                }
            }
        }
    }
}
