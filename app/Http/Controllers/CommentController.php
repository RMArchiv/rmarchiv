<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Http\Controllers;

use App\Events\Obyx;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Helpers\DatabaseHelper;
use GrahamCampbell\Markdown\Facades\Markdown;

class CommentController extends Controller
{
    public function add(Request $request)
    {
        $comment = new Comment();

        $comment->user_id = \Auth::id();
        $comment->content_id = $request->get('content_id');
        $comment->content_type = $request->get('content_type');
        $comment->comment_md = $request->get('msg');
        $comment->comment_html = Markdown::convertToHtml($request->get('msg'));

        $rate = $request->get('rating');

        if ($rate == 'up') {
            $comment->vote_up = 1;
            $comment->vote_down = 0;
            event(new Obyx('rating', \Auth::id()));
        } elseif ($rate == 'down') {
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
}
