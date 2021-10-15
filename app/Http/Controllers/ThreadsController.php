<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use Illuminate\Http\Request;

class ThreadsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->only(['store', 'create']);
    }

    public function index()
    {
        $threads = Thread::latest()->get();

        return view('threads.index',compact('threads'));
    }

    public function show($channId, Thread $thread)
    {
        return view('threads.show', compact('thread'));
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
}
