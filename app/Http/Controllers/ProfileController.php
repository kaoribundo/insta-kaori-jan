<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function show($id)
    {
        $user = $this->user->findOrFail($id);

        return view('users.profile.show')->with('user',$user);
    }

    public function follow($id)
    {
        $user = $this->user->findOrFail($id);

        return view('users.profile.follower')->with('user',$user);
    }

    public function following($id)
    {
        $user = $this->user->findOrFail($id);

        return view('users.profile.following')->with('user',$user);
    }

    public function edit($id)
    {
        $user = $this->user->findOrFail($id);

        return view('users.profile.edit')->with('user',$user);
    }

    public function update(Request $request)
    {
        $user = $this->user->findOrFail(Auth::user()->id);

        $user->name = $request->name;
        $user->introduction = $request->introduction;
        $user->email = $request->email;
        if ($request->avatar) {
            $user->avatar  = 'data:image/' . $request->avatar->extension() .
                ';base64,' . base64_encode(file_get_contents($request->avatar));
        }
        $user->save();

        return redirect()->route('profile.show', Auth::user()->id);
    }

    public function suggest_all(){
        
    }


}

