<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Follow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{

    private $post;
    private $category;
    private $follow;
    public function __construct(Post $post , Category $category, Follow $follow){
        $this->post = $post;
        $this->follow = $follow;
        $this->category = $category;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->category->all();

        return view('users.post.create')->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     */

    // private function saveImageFile($request){
    //     //make file name
    //     $file_name = time().".".$request->image->extension();
    //     //887908379.jpg

    //     //save the file in the folder
    //     $request->image->storeAs(self::STORAGE_FOLDER, $file_name);

    //     return $file_name;
    // }

    public function store(Request $request)
    {

        // $request->validate([
        //     'category' => 'required|array|between:1,3',
        //     'desc' => 'required',
        //     'image' => 'max:1048|mimes:jpg, jpeg, png, gif'
        //     // for files , max = maximum size is KB
        //     //mimes = file types allowed
        // ]);

        //
        $this->post->user_id = Auth::user()->id;
        $this->post->description = $request->description;
        // convert image to text and save it to database : convert it into base:64 text
        $this->post->image = 'data:image/' . $request->image->extension() .
        ';base64,' . base64_encode(file_get_contents($request->image));
        // return $request->category;
        $this->post->save(); // it will generate ID after saving


        #create a array that would accept the categories inside the form
        foreach($request->category as $category_id){
            $category_post[] = ["category_id"=>$category_id];
        }

        $this->post->categoryPost()->createMany($category_post);

        return redirect()->route('index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $post = $this->post->findOrFail($id);
        $all_follows = $this->follow->all();

        return view('users.post.show')->with('post', $post)->with('all_follows',$all_follows);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $post = $this->post->findOrFail($id);
        $categories = $this->category->all();

        $selected_categories = []; //we put the selected categories of this post

        foreach($post->categoryPost as $category_post){
            $selected_categories[] = $category_post->category_id;
        }

        return view('users.post.edit')
            ->with('post', $post)
            ->with('categories', $categories)
            ->with('selected_categories',$selected_categories);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $post = $this->post->findOrFail($id);

        // $post->user_id = Auth::user()->id;
        $post->description = $request->description;
        // $post->image = $post->image;
        // convert image to text and save it to database : convert it into base:64 text
        if($request->image){
            $post->image = 'data:image/' . $request->image->extension() .
            ';base64,' . base64_encode(file_get_contents($request->image));
        }

        $post->save();

        #create a array that would accept the categories inside the form
        foreach($request->category as $category_id){
            $category_post[] = ["category_id"=>$category_id ,
                                "post_id"=>$id
                                ];
        }

        $post->categoryPost()->delete();
        $post->categoryPost()->createMany($category_post);

        // return view('users.post.show')->with('post', $post);
        return redirect()->route('post.show',$id);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $post = $this->post->findOrFail($id);

        $post->delete();

        return redirect()->route('index');
    }
}
