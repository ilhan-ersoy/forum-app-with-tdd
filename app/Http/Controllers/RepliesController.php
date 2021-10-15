<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use Illuminate\Http\Request;

class RepliesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->only('store');
    }

    public function store($channelId, Thread $thread)
    {

        $thread->addReply([
            'body' => request('body'),
            'user_id' => auth()->id()
        ]);

        return redirect()->back();

    }
}
