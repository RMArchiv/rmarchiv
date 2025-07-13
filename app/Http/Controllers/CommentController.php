<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Http\Controllers;

use App\Events\Obyx;
use App\Helpers\CheckRateableHelper;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Helpers\DatabaseHelper;
use App\Models\User;
use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function delete(Request $request, $comment_id)
    {
        $c = Comment::whereId($comment_id)->first();
        $c->deleted = 1;
        $c->delete_reason = $request->get('reason');
        $c->save();

        return redirect()->back();
    }

    public function restore(Request $request, $comment_id)
    {
        $c = Comment::whereId($comment_id)->first();
        $c->deleted = 0;
        $c->delete_reason = '';
        $c->save();

        return redirect()->back();
    }

    public function add(Request $request)
    {
        $comment = new Comment();

        $comment->user_id = Auth::id();
        $comment->content_id = $request->get('content_id');
        $comment->content_type = $request->get('content_type');
        $comment->comment_md = $request->get('msg');
        $comment->comment_html = Markdown::convert($request->get('msg'));

        $rate = $request->get('rating');
        $allowedToRate = CheckRateableHelper::checkRateable($comment->content_type, $comment->content_id, Auth::id());

        if ($rate == 'up' && $allowedToRate) {
            $comment->vote_up = 1;
            $comment->vote_down = 0;
            event(new Obyx('rating', \Auth::id()));
        } elseif ($rate == 'down' && $allowedToRate) {
            $comment->vote_up = 0;
            $comment->vote_down = 1;
            event(new Obyx('rating', \Auth::id()));
        } else {
            $comment->vote_up = 0;
            $comment->vote_down = 0;
        }

        $comment->save();

        event(new Obyx('comment', \Auth::id()));

        if ($request->get('content_type') == 'game') {
            DatabaseHelper::setVotesAndComments($request->get('content_id'));
        }

        return redirect()->action('MsgBoxController@comment_add', [$request->get('content_type'), $request->get('content_id')]);
    }

    // Alternative function to checkRateable
    public static function hasUserRatedGame($id) {
        $ratedGame = false;
        if(Auth::check()) {
            // logical grouping of where clauses to simulate brackets
            $comments = User::whereId(Auth::id())->first()->comments()->where(
                "deleted", "=", 0)
                ->where(function (Builder $query) {
                    $query->orWhere("vote_up", "=", 1)->orWhere("vote_down", "=", 1);
                })
                ->orderBy('updated_at')->get();

            foreach ($comments as $comment) {
                if($comment->content_id == $id && $comment->content_type == "game") {
                    $ratedGame = true;
                }
            }
            return $ratedGame;
        }
        else {
            return false;
        }
    }
}
