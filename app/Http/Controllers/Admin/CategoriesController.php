<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use App\Models\CategoryPost;

class CategoriesController extends Controller
{
    private $category;
    private $post;
    private $category_post;
    public function __construct(Category $category, Post $post, CategoryPost $category_post){
        $this->category = $category;
        $this->post = $post;
        $this->category_post = $category_post;
    }

    // public function index(){
    //     $all_categories = $this->category->latest()->get();

    //     $all_posts = $this->post->all();
    //     $all_posts_count = $all_posts->count();

    //     $all_categorized_posts_count = 0;

    //     foreach($all_posts as $post){
    //         // $cnt = $post->categoryPost->count();
    //         // $all_categorized_posts_count = $all_categorized_posts_count + $cnt;
    //         if($post->categoryPost()->count() == 0){
    //             $all_categorized_posts_count++;
    //         }
    //     }

    //     $uncategorized_post_cnt = $all_posts_count - $all_categorized_posts_count;

    //     return view('admin.categories.index')
    //         ->with('all_categories',$all_categories)
    //         ->with('uncategorized_post_cnt',$uncategorized_post_cnt)
    //         ->with('all_posts_count',$all_posts_count)
    //         ->with('all_categorized_posts_count',$all_categorized_posts_count);
    // }
    public function index(){
        $all_categories = $this->category->all();
        $uncategorized_post = 0;
        $all_posts = $this->post->all();
        foreach($all_posts as $post){
            if($post->categoryPost()->count() == 0){
                    $uncategorized_post++;
            }
        }

        return view('admin.categories.index')->with('all_categories',$all_categories)->with('uncategorized_post',$uncategorized_post);
    }

    public function create(Request $request){
        $this->category->name = $request->category;
        $this->category->save();

        $all_categories = $this->category->latest()->get();

        return redirect()->route('admin.categories.index');
    }

    public function edit(Request $request, $id){
        $category = $this->category->findOrfail($id);
        $category->name = $request->category;
        $category->save();

        return redirect()->route('admin.categories.index');
    }

    public function delete($id){
        $this->category->destroy($id); //automatically categorypost table is deleted.

        return redirect()->route('admin.categories.index');
    }
}
