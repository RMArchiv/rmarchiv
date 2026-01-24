<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Http\Controllers\Api\v3;

use App\Http\Controllers\Controller;
use App\Models\UserList;
use App\Models\UserListItem;
use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserListsController extends Controller
{
    public function __construct()
    {
        $this->middleware('api.token')->only(['store', 'update', 'destroy', 'addItem', 'removeItem']);
    }

    public function index($userId)
    {
        \Debugbar::disable();

        $lists = UserList::whereUserId($userId)
            ->orderBy('created_at', 'desc')
            ->get(['id', 'user_id', 'title', 'desc_md', 'desc_html', 'created_at', 'updated_at']);

        return response()->json([
            'status_code' => 200,
            'message' => 'User lists',
            'data' => $lists,
        ]);
    }

    public function show($listId)
    {
        \Debugbar::disable();

        $list = UserList::with(['listitems.game'])
            ->whereId($listId)
            ->first();

        if (! $list) {
            return response()->json([
                'status_code' => 404,
                'message' => 'List not found',
            ], 404);
        }

        $items = $list->listitems->map(function (UserListItem $item) {
            return [
                'id' => $item->id,
                'content_id' => $item->content_id,
                'content_type' => $item->content_type,
                'game' => $item->game ? [
                    'id' => $item->game->id,
                    'title' => $item->game->title,
                    'subtitle' => $item->game->subtitle,
                ] : null,
                'created_at' => $item->created_at,
            ];
        });

        return response()->json([
            'status_code' => 200,
            'message' => 'User list',
            'data' => [
                'id' => $list->id,
                'user_id' => $list->user_id,
                'title' => $list->title,
                'desc_md' => $list->desc_md,
                'desc_html' => $list->desc_html,
                'created_at' => $list->created_at,
                'updated_at' => $list->updated_at,
                'items' => $items,
            ],
        ]);
    }

    public function store(Request $request)
    {
        \Debugbar::disable();

        $title = trim((string) $request->input('title', ''));
        if ($title === '') {
            return response()->json([
                'status_code' => 422,
                'message' => 'Title is required.',
            ], 422);
        }

        $desc = (string) $request->input('desc', '');

        $list = new UserList();
        $list->user_id = Auth::id();
        $list->title = $title;
        $list->desc_md = $desc;
        $list->desc_html = $desc !== '' ? Markdown::convert($desc) : '';
        $list->save();

        return response()->json([
            'status_code' => 201,
            'message' => 'List created',
            'data' => $list,
        ], 201);
    }

    public function update(Request $request, $listId)
    {
        \Debugbar::disable();

        $list = UserList::whereId($listId)->first();
        if (! $list) {
            return response()->json([
                'status_code' => 404,
                'message' => 'List not found',
            ], 404);
        }

        if ((int) $list->user_id !== (int) Auth::id()) {
            return response()->json([
                'status_code' => 403,
                'message' => 'Not allowed to edit this list.',
            ], 403);
        }

        $title = trim((string) $request->input('title', $list->title));
        $desc = (string) $request->input('desc', $list->desc_md);

        $list->title = $title === '' ? $list->title : $title;
        $list->desc_md = $desc;
        $list->desc_html = $desc !== '' ? Markdown::convert($desc) : '';
        $list->save();

        return response()->json([
            'status_code' => 200,
            'message' => 'List updated',
            'data' => $list,
        ]);
    }

    public function destroy($listId)
    {
        \Debugbar::disable();

        $list = UserList::whereId($listId)->first();
        if (! $list) {
            return response()->json([
                'status_code' => 404,
                'message' => 'List not found',
            ], 404);
        }

        if ((int) $list->user_id !== (int) Auth::id()) {
            return response()->json([
                'status_code' => 403,
                'message' => 'Not allowed to delete this list.',
            ], 403);
        }

        UserListItem::whereListId($list->id)->delete();
        $list->delete();

        return response()->json([
            'status_code' => 200,
            'message' => 'List deleted',
        ]);
    }

    public function addItem(Request $request, $listId)
    {
        \Debugbar::disable();

        $list = UserList::whereId($listId)->first();
        if (! $list) {
            return response()->json([
                'status_code' => 404,
                'message' => 'List not found',
            ], 404);
        }

        if ((int) $list->user_id !== (int) Auth::id()) {
            return response()->json([
                'status_code' => 403,
                'message' => 'Not allowed to edit this list.',
            ], 403);
        }

        $gameId = (int) $request->input('game_id', 0);
        if ($gameId <= 0) {
            return response()->json([
                'status_code' => 422,
                'message' => 'game_id is required.',
            ], 422);
        }

        $exists = UserListItem::whereListId($list->id)
            ->where('content_type', '=', 'game')
            ->where('content_id', '=', $gameId)
            ->first();

        if (! $exists) {
            UserListItem::create([
                'content_id' => $gameId,
                'content_type' => 'game',
                'user_id' => Auth::id(),
                'list_id' => $list->id,
            ]);
        }

        return response()->json([
            'status_code' => 200,
            'message' => 'Item added',
        ]);
    }

    public function removeItem($listId, $itemId)
    {
        \Debugbar::disable();

        $list = UserList::whereId($listId)->first();
        if (! $list) {
            return response()->json([
                'status_code' => 404,
                'message' => 'List not found',
            ], 404);
        }

        if ((int) $list->user_id !== (int) Auth::id()) {
            return response()->json([
                'status_code' => 403,
                'message' => 'Not allowed to edit this list.',
            ], 403);
        }

        $item = UserListItem::whereId($itemId)->whereListId($list->id)->first();
        if (! $item) {
            return response()->json([
                'status_code' => 404,
                'message' => 'List item not found',
            ], 404);
        }

        $item->delete();

        return response()->json([
            'status_code' => 200,
            'message' => 'Item removed',
        ]);
    }
}
