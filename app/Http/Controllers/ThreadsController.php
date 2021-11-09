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
        $this->middleware('auth')->only(['store', 'create', 'destroy']);
    }

    public function index(Channel $channel)
    {
        $threads = $this->getThreads($channel);

//        return $channel;
        if (request()->wantsJson()){
            return $threads;
        }

        return view('threads.index',compact(['threads']));
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

    public function destroy($channel, Thread $thread)
    {
        $this->authorize('update', $thread);
        $thread->replies()->delete();
        $thread->delete();

        return redirect('/threads');
    }

    public function getThreads(Channel $channel)
    {

        if ($channel->exists) {
            $threads = $channel->threads()->latest();
        } else {
            $threads = Thread::with(['replies','creator','channel'])->latest();
        }


        if (request()->get('by')) {
            $user = User::where('name', request()->get('by'))->firstOrFail();
            $threads->with(['replies','creator','channel'])->where('user_id', $user->id);
        }elseif(request()->get('popularity')){
            $threads = Thread::withCount('replies')->with(['replies','channel'])->orderBy("replies_count", "desc");
        }

        $threads = $threads->get();

        return $threads;
    }

}
