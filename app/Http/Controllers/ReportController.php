<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Http\Controllers;

use App\Models\BoardPost;
use App\Models\Comment;
use App\Models\Game;
use App\Models\UserReport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ReportController extends Controller
{
    public function index()
    {
        $r = UserReport::all();

        return view('reports.index', [
            'reports' => $r,
        ]);
    }

    public function create_game_report($gameid)
    {
        $g = Game::whereId($gameid)->first();

        return view('reports.create', [
            'game' => $g,
        ]);
    }

    public function store_game_report(Request $request, $gameid)
    {
        $r = new UserReport();
        $r->content_id = $gameid;
        $r->content_type = 'game';
        $r->reason = $request->get('msg');
        $r->user_id = \Auth::id();
        $r->save();

        return redirect()->action('ReportController@index_user');
    }

    public function index_user()
    {
        if (\Auth::check()) {
            if (\Auth::user()->can('admin-games')) {
                $ur = UserReport::all();
            } else {
                $ur = UserReport::whereUserId(\Auth::id())->get();
            }
        } else {
            $ur = null;
        }

        return view('reports.index', [
            'reports' => $ur,
        ]);
    }

    public function close_ticket($id)
    {
        $t = UserReport::whereId($id)->first();
        $t->closed = 1;
        $t->closed_at = Carbon::now();
        $t->closed_user_id = \Auth::id();
        $t->save();

        return redirect()->action('ReportController@index_user');
    }

    public function open_ticket($id)
    {
        $t = UserReport::whereId($id)->first();
        $t->closed = 0;
        $t->closed_at = Carbon::now();
        $t->closed_user_id = \Auth::id();
        $t->save();

        return redirect()->action('ReportController@index_user');
    }

    public function remark_ticket($id)
    {
    }

    public function store_content_report(Request $request)
    {
        $data = $request->validate([
            'content_type' => ['required', Rule::in(['comment', 'board_post'])],
            'content_id' => ['required', 'integer'],
            'reason' => ['required', 'string', 'min:5', 'max:5000'],
        ]);

        if ($data['content_type'] === 'comment') {
            $content = Comment::findOrFail($data['content_id']);
        } else {
            $content = BoardPost::findOrFail($data['content_id']);
        }

        $report = new UserReport();
        $report->content_id = $content->id;
        $report->content_type = $data['content_type'];
        $report->reason = $data['reason'];
        $report->user_id = \Auth::id();
        $report->closed = 0;
        $report->save();

        return redirect()->back();
    }

    public function reported_comments()
    {
        abort_unless($this->canModerateReports(), 403);

        $reports = UserReport::with([
            'user',
            'user_closed',
            'comment.user',
            'comment.game',
            'comment.news',
            'comment.resource',
            'comment.event',
            'boardPost.user',
            'boardPost.thread',
        ])
            ->whereIn('content_type', $this->visibleReportTypes())
            ->orderBy('closed')
            ->orderBy('created_at', 'desc')
            ->paginate(25);

        return view('reports.reported-comments', [
            'reports' => $reports,
        ]);
    }

    public function update_report_status(Request $request, $id)
    {
        abort_unless($this->canModerateReports(), 403);

        $data = $request->validate([
            'closed' => ['required', Rule::in(['0', '1'])],
        ]);

        $report = UserReport::whereIn('content_type', $this->visibleReportTypes())->findOrFail($id);
        $report->closed = (int) $data['closed'];
        $report->closed_at = Carbon::now();
        $report->closed_user_id = \Auth::id();
        $report->save();

        return redirect()->route('reports.comments.index');
    }

    public function update_report_note(Request $request, $id)
    {
        abort_unless($this->canModerateReports(), 403);

        $data = $request->validate([
            'closed_remarks' => ['nullable', 'string', 'max:5000'],
        ]);

        $report = UserReport::whereIn('content_type', $this->visibleReportTypes())->findOrFail($id);
        $report->closed_remarks = $data['closed_remarks'];
        $report->closed_at = Carbon::now();
        $report->closed_user_id = \Auth::id();
        $report->save();

        return redirect()->route('reports.comments.index');
    }

    protected function canModerateReports()
    {
        if (! \Auth::check()) {
            return false;
        }

        return \Auth::user()->hasRole(['admin', 'owner', 'moderator'])
            || \Auth::user()->can('admin-comments')
            || \Auth::user()->can('mod-threads');
    }

    protected function visibleReportTypes()
    {
        if (\Auth::user()->hasRole(['admin', 'owner', 'moderator'])) {
            return ['comment', 'board_post'];
        }

        $types = [];

        if (\Auth::user()->can('admin-comments')) {
            $types[] = 'comment';
        }

        if (\Auth::user()->can('mod-threads')) {
            $types[] = 'board_post';
        }

        return $types;
    }
}
