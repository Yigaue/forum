<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Thread;

class RepliesController extends Controller
{
        public function __construct(){
            $this->middleware('auth');
        }

    public function store ($channelId, Thread $thread)
    {

            $this->validate(request(),
             [
                'body'=>'required',
            ]);
           $thread ->addReply([
               'body'=> request('body'),
               'user_id'=> auth()->id(),
           ]);

           return back()->with('flash', 'Your replies has been sent');
    }
}
