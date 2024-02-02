<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Follow;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $post;
    private $user;
    private $follow;
    public function __construct(Post $post, User $user, Follow $follow)
    {
        $this->post = $post;
        $this->user = $user;
        $this->follow = $follow;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $all_posts = $this->post->latest()->get();

        // filter the post

        $follower_posts = [];

        foreach ($all_posts as $post) {
            if ($post->user->isfollowed() || $post->user->id == Auth::user()->id) {
                $follower_posts[] = $post;
            }
        }

        // show suggested users

        $all_users = User::all()->except(Auth::user()->id);

        $suggested_users = [];

        foreach ($all_users as $user) {
            if (!$user->isFollowed()) {
                $suggested_users[] = $user;
            }
        }

        return view('users.home')
            // ->with('all_posts',$all_posts)
            ->with('suggested_users', $suggested_users)
            ->with('follower_posts', $follower_posts);
    }

    public function suggest_all()
    {
        // show suggested users

        $all_users = User::all()->except(Auth::user()->id);

        $suggested_users = [];

        foreach ($all_users as $user) {
            if (!$user->isFollowed()) {
                $suggested_users[] = $user;
            }
        }
        return view('users.suggested')
            ->with('suggested_users', $suggested_users);
    }

    public function search(Request $request)
    {
        $all_users = User::all()->except(Auth::user()->id);

        $suggested_users = [];

        foreach ($all_users as $user) {
            if (!$user->isFollowed()) {
                $suggested_users[] = $user;
            }
        }

        // Check for search input
        if (isset($request->search)) {
            $suggested_users = User::where('name', 'like', '%' . $request->search . '%')->get();

        }
        $value = $request->search;


        return view('users.people')
            ->with('suggested_users', $suggested_users)
            ->with('value', $value);
    }
}
