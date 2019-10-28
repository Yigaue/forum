<?php

namespace App\Http\Controllers;

use App\Favorite;
use App\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FavoritesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
   public function store(Reply $reply)
   {
    // $favorite = Favorite::create([
    //     'user_id' => auth()->id(),
    //     'favorited_id' =>$reply->id,
    //     'favorited_type' =>get_class($reply)

    // ]);
    /*
    | We can remove the above commented code. and user the one below (reference from the controller)
    | since we the relationship b/w reply and favorite is polymorphic
    |   the user_id is supplied and eloquent creates the others 
    */
    $reply->favorite();
     return back();
    
   }
   

}
