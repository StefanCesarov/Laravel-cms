<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tags;
use App\Http\Requests\Post\PostCreateRequest;
use App\Http\Requests\Post\PostUpdateRequest;
use Illuminate\Http\UploadedFile;
use App\Http\Middleware\CheckCategoryCcreated;


class PostController extends Controller
{


    public function __construct()
    {
        $this->middleware('App\Http\Middleware\CheckCategoryCcreated')->only(['create', 'store']);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('posts.index')->with('posts', Post::all())->with('categories', Category::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create')->with('categories', Category::all())->with('tags', Tags::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostCreateRequest $request)
    {
        $img = $request->img->store('post');
        $user_id = auth()->user()->id;

        $post = Post::create([
            'name' => $request->name,
            'description' => $request->description,
            'content' => $request->content,
            'img' => $img,
            'published_at' => $request->published_at,
            'category_id' => $request->category_id,
            'user_id' => $user_id

        ]);

        if($request->tag_id)
        {
            $post->tags()->attach($request->tag_id);
        }
        
        session()->flash('success', 'Post saved');
        return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.create')->with('post', $post)->with('categories', Category::all())->with('tags', Tags::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostUpdateRequest $request, Post $post)
    {
        $data = $request->only(['name', 'description', 'content', 'published_at', 'category_id']);
        
       if($request->hasFile('image'))
       {
            $img = $request->img->store('post');
            $post->deleteFromStorage();
            $data['img'] = $img;
        }

        if($request->tag_id)
        {
            $post->tags()->sync($request->tag_id);
        }

       

        $post->update($data);
        session()->flash('success', 'Post updated successfully');
        return redirect(route('posts.index'));
    }

     /**
     * Displays trashed posts.
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function showTrashedPosts ()
    {
        $posts = Post::onlyTrashed()->get();
        return view('posts.index')->with('posts', $posts);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::withTrashed()->where('id', $id)->firstOrFail();
        if ($post->trashed())
        {
            $post->deleteFromStorage();
            $post->forceDelete();
        }else
        {
            $post->delete();    
        }
        
        session()->flash('success', 'Post deleted successfully');
        return redirect(route('posts.index'));
    }

     /**
     * Restore the specified post.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restorePost ($id)
    {
        $post = Post::withTrashed()->where('id', $id)->firstOrFail();

        $post->restore();
        session()->flash('success', 'Post restored successfully');
        return redirect()->back();
    }
}
