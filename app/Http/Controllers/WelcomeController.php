<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tags;

class WelcomeController extends Controller
{
    //

    public function index ()
    {

        $search = request()->query('search');
        if(request()->query('search'))
        {
            $posts = Post::published()->where('name', 'LIKE', "%{$search}%")->simplePaginate(2);
        }
        else
        {
            $posts = Post::published()->simplePaginate(4);
        }

        return view('welcome')
            ->with('categories', Category::all())
            ->with('posts', $posts)
            ->with('tags', Tags::all());
    
    }
}
