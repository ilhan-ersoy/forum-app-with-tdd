<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Http\Request;

class ThreadsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->only(['store', 'create']);
    }

    public function index(Channel $channel)
    {

        $threads = $this->getThreads($channel);

        return view('threads.index',compact('threads'));
    }

    public function show($channId, Thread $thread)
    {
        return view('threads.show', [
            'thread' => $thread,
            'replies' => $thread->replies()->paginate(20)
        ]);
    }

    public function store(Request $request)
    {

        // VALIDATION ....
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'channel_id' => "required | exists:channels,id"
        ]);

        $thread = Thread::create([
            'user_id' => auth()->id(),
            'channel_id' => request('channel_id'),
            'title' => request('title'),
            'body' => request('body')
        ]);

        return redirect()->route('thread.show',['thread' => $thread, 'channel' => $thread->channel]);
    }

    public function create()
    {
        return view('threads.create');
    }

    public function getThreads(Channel $channel)
    {
        if ($channel->exists) {
            $threads = $channel->threads()->latest();
        } else {
            $threads = Thread::latest();
        }


        if (request()->get('by')) {
            $user = User::where('name', request()->get('by'))->firstOrFail();
            $threads->where('user_id', $user->id);
        }

        $threads = $threads->get();
        return $threads;
    }

}
