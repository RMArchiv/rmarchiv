<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Developer;

class AutocompleteController extends Controller
{
    public function developer($term)
    {
        $result = [];

        //$devs = Developer::whereName($term)->get();
        $devs = \DB::table('developer')
            ->select(['id', 'name'])
            ->where('developer.name', 'like', '%'.$term.'%')
            ->get();

        foreach ($devs as $dev) {
            $result[] = ['id' => $dev->id, 'value' => $dev->name];
        }

        return \Response::json($result);
    }

    public function game($term)
    {
        $result = [];

        $games = \DB::table('games')
            ->select([
                'id',
                'title',
                'subtitle',
            ])
            ->where('title', 'like', '%'.$term.'%')
            ->orWhere('subtitle', 'like', '%'.$term.'%')
            ->get();

        foreach ($games as $g) {
            if (is_null($g->subtitle) || $g->subtitle == '') {
                $result[] = ['id' => $g->id, 'value' => $g->title];
            } else {
                $result[] = ['id' => $g->id, 'value' => $g->title.' -=- '.$g->subtitle];
            }
        }

        return \Response::json($result);
    }

    public function faqcat($term)
    {
        $result = [];

        //$devs = Developer::whereName($term)->get();
        $devs = \DB::table('faq')
            ->select(['id', 'cat'])
            ->where('faq.cat', 'like', '%'.$term.'%')
            ->groupBy('faq.cat')
            ->get();

        foreach ($devs as $dev) {
            $result[] = ['id' => $dev->id, 'value' => $dev->cat];
        }

        return \Response::json($result);
    }

    public function awardpage($term)
    {
        $result = [];
        $aw = \DB::table('award_pages')->get();

        foreach ($aw as $item) {
            $result[] = [
                'id'    => $item->id,
                'value' => $item->title,
            ];
        }

        return \Response::json($result);
    }

    public function awardcat($term)
    {
        $result = [];
        $aw = \DB::table('award_cats')->get();

        foreach ($aw as $item) {
            $result[] = [
                'id'    => $item->id,
                'value' => $item->title,
            ];
        }

        return \Response::json($result);
    }

    public function awardsubcat($term)
    {
        $result = [];
        $aw = \DB::table('award_subcats')->get();

        foreach ($aw as $item) {
            $result[] = [
                'id'    => $item->id,
                'value' => $item->title,
            ];
        }

        return \Response::json($result);
    }

    public function user($term)
    {
        $result = [];
        $users = User::where('name', 'like', '%'.$term.'%')->get();

        foreach ($users as $user) {
            $result[] = [
                'id'    => $user->id,
                'value' => $user->name,
            ];
        }

        return \Response::json($result);
    }
}
