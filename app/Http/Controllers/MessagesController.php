<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Cmgmyr\Messenger\Models\Thread;
use Cmgmyr\Messenger\Models\Message;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Cmgmyr\Messenger\Models\Participant;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class MessagesController extends Controller
{
    public function index()
    {
        $currentUserId = \Auth::id();

        //Alle threads laden, abgesehen von gelöscht und archivierten empfängern
        //$threads = Thread::getAllLatest()->get();

        // All threads that user is participating in
        $threads = Thread::forUser($currentUserId)->latest('updated_at')->paginate(25);
        // All threads that user is participating in, with new messages
        // $threads = Thread::forUserWithNewMessages($currentUserId)->latest('updated_at')->get();

        $users = User::where('id', '!=', \Auth::id())->get();

        return view('messenger.index', compact('threads', 'currentUserId', 'users'));
    }

    public function create()
    {
        $users = User::where('id', '!=', \Auth::id())->get();

        return view('messenger.create', compact('users'));
    }

    public function store(\Request $request)
    {
        $input = $request->all();
        $thread = Thread::create(
            [
                'subject' => $input['subject'],
            ]
        );
        // Message
        Message::create(
            [
                'thread_id' => $thread->id,
                'user_id'   => \Auth::user()->id,
                'body'      => $input['msg'],
            ]
        );
        // Sender
        Participant::create(
            [
                'thread_id' => $thread->id,
                'user_id'   => \Auth::user()->id,
                'last_read' => new Carbon(),
            ]
        );
        // Recipients
        foreach ($input['recipients'] as $rec) {
            Participant::create(
                [
                    'thread_id' => $thread->id,
                    'user_id'   => $rec,
                ]
            );
        }

        return redirect('messages');
    }

    public function show(\Request $requenst, $id)
    {
        if (\Auth::check()) {
            try {
                $thread = Thread::findOrFail($id);
            } catch (ModelNotFoundException $e) {
                Session::flash('error_message', 'Thema mit der ID: '.$id.' konnte nicht gefunden werden.');

                return redirect('messages');
            }
            // show current user in list if not a current participant
            // $users = User::whereNotIn('id', $thread->participantsUserIds())->get();
            // don't show the current user in list
            $userId = \Auth::user()->id;
            if ($thread->hasParticipant($userId)) {
                $users = User::whereNotIn('id', $thread->participantsUserIds($userId))->get();
                $thread->markAsRead($userId);
                $messages = $thread->messages()->paginate(25);

                if (! $requenst->get('page')) {
                    return redirect('messages/'.$id.'?page='.$messages->lastPage());
                } else {
                    return view('messenger.show', compact('thread', 'users', 'messages'));
                }
            }
            //Todo:View für Keine Berechtigung.
        }
    }

    public function update(\Request $request, $id)
    {
        if (\Auth::check()) {
            try {
                $thread = Thread::findOrFail($id);
            } catch (ModelNotFoundException $e) {
                Session::flash('error_message', 'Thema mit der ID: '.$id.' konnte nicht gefunden werden.');

                return redirect('messages');
            }
            $thread->activateAllParticipants();
            // Message
            Message::create(
                [
                    'thread_id' => $thread->id,
                    'user_id'   => \Auth::id(),
                    'body'      => $request->get('msg'),
                ]
            );
            // Add replier as a participant
            $participant = Participant::firstOrCreate(
                [
                    'thread_id' => $thread->id,
                    'user_id'   => \Auth::user()->id,
                ]
            );
            $participant->last_read = new Carbon();
            $participant->save();
            // Recipients
            if ($request->has('recipients')) {
                $thread->addParticipant(\Request::get('recipients'));
            }

            return redirect('messages/'.$id);
        }

        //Todo:View für Keine Berechtigung
    }
}
