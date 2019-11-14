<?php

namespace App\Http\Controllers;

use App\Reply;
use Illuminate\Http\Request;
use App\Thread;

class RepliesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except'=>'index']);
    }

    public function index($channelId, Thread $thread)
    {
        return $thread->replies()->paginate(20);
    }

    public function store($channelId, Thread $thread)
    {
        $this->validate(
            request(),
            [
                'body'=>'required',
            ]
        );
        $reply =  $thread ->addReply([
               'body'=> request('body'),
               'user_id'=> auth()->id(),
           ]);

        if (request()->expectsJson()) {
            return $reply->load('owner');
        }

        return back()->with('flash', 'Your replies has been sent');
    }
    public function update(Reply $reply)
    {
        $reply->update(request(['body']));

        //OR
        // $reply->update(['body'=>request('body')]);
    }

    public function destroy(Reply $reply)
    {
        $this->authorize('update', $reply);

        $reply->delete();

        if (request()->expectsJson()) {
            return response(['status'=>'Reply deleted']);
        }
        return back();
    }
}
