<?php

namespace App\Http\Controllers;

use Spatie\Activitylog\Models\Activity;

class HistoryController extends Controller
{
    public function index($id)
    {
        $a = Activity::all()->where('subject_type', '=', 'App\Models\Game')
            ->where('subject_id', '=', $id);

        return view('history.index_game', [
            'activity' => $a,
        ]);
    }
}
