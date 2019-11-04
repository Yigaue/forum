<?php

namespace App\Http\Controllers;

use App\Activity;
use App\User;
use Illuminate\Http\Request;


class ProfilesController extends Controller
{
    public function show(User $user)
    {

        return view('profiles.show', [
            'profileUser'=> $user,
            'activities' => Activity::feed($user),

            //* Alternative method */ 'activities' => $this->getActivity($user),
            //  'threads'=>$user->activity()->paginate(30)

        ]);
    }

   }
