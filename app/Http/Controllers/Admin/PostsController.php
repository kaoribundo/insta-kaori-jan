<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;


class PostsController extends Controller
{
    private $post;
    public function __construct(Post $post){
        $this->post = $post;
    }

    public function index(){

        $posts = $this->post->withTrashed()->latest()->paginate(8);
        return view('admin.posts.index')
            ->with('posts',$posts);
    }
    public function hide($id){

        $this->post->findOrFail($id)->delete();

        return redirect()->back();
    }
    public function restore($id){

        $this->post->onlyTrashed()->findOrFail($id)->restore();;

        return redirect()->back();
    }
}
