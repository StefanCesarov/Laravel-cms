<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tags;
use App\Models\Category;

class PostController extends Controller
{
    
    // show single post on the webpage
    public function show(Post $post)
    {
        return view('blog.single_blog')->with('post', $post);
    }

    public function category (Category $category)
    {
        return view('blog.category')
        ->with('category', $category)
        ->with('categories', Category::all())
        ->with('posts', $category->posts()->searched()->simplePaginate(4))
        ->with('tags', Tags::all());
    }

    public function tag (Tags $tag)
    {
     
        return view('blog.tag')
        ->with('tag', $tag)
        ->with('tags', Tags::all())
        ->with('categories', Category::all())
        ->with('posts', $tag->posts()->searched()->simplePaginate(4));
        
    }
}
