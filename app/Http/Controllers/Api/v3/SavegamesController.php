<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Http\Controllers\Api\v3;

use App\Http\Controllers\Controller;
use App\Models\GamesFile;
use App\Models\GamesSavegame;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SavegamesController extends Controller
{
    public function __construct()
    {
        $this->middleware('api.token');
    }

    public function index($gamefileId)
    {
        \Debugbar::disable();

        $gamefile = GamesFile::whereId($gamefileId)->first();
        if (! $gamefile) {
            return response()->json([
                'status_code' => 404,
                'message' => 'Gamefile not found',
            ], 404);
        }

        $savegames = GamesSavegame::whereGamefileId($gamefileId)
            ->where('user_id', '=', Auth::id())
            ->get();

        $data = [];
        foreach ($savegames as $savegame) {
            $data[(string) $savegame->slot_id] = $savegame->save_data;
        }

        return response()->json([
            'status_code' => 200,
            'message' => 'Savegames',
            'data' => $data,
        ]);
    }

    public function store(Request $request, $gamefileId)
    {
        \Debugbar::disable();

        $gamefile = GamesFile::whereId($gamefileId)->first();
        if (! $gamefile) {
            return response()->json([
                'status_code' => 404,
                'message' => 'Gamefile not found',
            ], 404);
        }

        $payload = $request->json()->all();
        if (isset($payload['slots']) && is_array($payload['slots'])) {
            $slots = $payload['slots'];
        } elseif (is_array($payload) && count($payload) > 0) {
            $slots = $payload;
        } else {
            $raw = $request->getContent();
            $decoded = json_decode($raw, true);
            $slots = is_array($decoded) ? $decoded : [];
        }

        if (! is_array($slots) || count($slots) === 0) {
            return response()->json([
                'status_code' => 422,
                'message' => 'No savegame data provided.',
            ], 422);
        }

        $savedCount = 0;
        foreach ($slots as $slotId => $saveData) {
            GamesSavegame::updateOrCreate([
                'user_id' => Auth::id(),
                'gamefile_id' => $gamefileId,
                'slot_id' => $slotId,
            ], [
                'save_data' => $saveData,
            ]);
            $savedCount++;
        }

        return response()->json([
            'status_code' => 200,
            'message' => 'Savegames stored',
            'data' => [
                'saved' => $savedCount,
            ],
        ]);
    }

    public function storeSlot(Request $request, $gamefileId, $slotId)
    {
        \Debugbar::disable();

        $gamefile = GamesFile::whereId($gamefileId)->first();
        if (! $gamefile) {
            return response()->json([
                'status_code' => 404,
                'message' => 'Gamefile not found',
            ], 404);
        }

        $saveData = $request->input('save_data');
        if ($saveData === null) {
            $saveData = $request->getContent();
        }

        if ($saveData === null || $saveData === '') {
            return response()->json([
                'status_code' => 422,
                'message' => 'No savegame data provided.',
            ], 422);
        }

        GamesSavegame::updateOrCreate([
            'user_id' => Auth::id(),
            'gamefile_id' => $gamefileId,
            'slot_id' => $slotId,
        ], [
            'save_data' => $saveData,
        ]);

        return response()->json([
            'status_code' => 200,
            'message' => 'Savegame stored',
            'data' => [
                'slot_id' => (int) $slotId,
            ],
        ]);
    }
}
