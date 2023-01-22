<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::latest()->take(10)->published()->get();
        return view('welcome', compact('posts'));

    }
    public function post($slug)
    {
        $post = Post::where('slug', $slug)->published()->first();
        // $posts = Post::latest()->take(3)->published()->get();
        // Increase View count
        $postKey = 'post_'.$post->id;
        if(!Session::has($postKey)){
            $post->increment('view_count');
            Session::put($postKey, 1);
        }

        return view('post', compact('post'));
    }
    public function posts()
    {
        $posts = Post::latest()->published()->paginate(10);
        return view('posts', compact('posts'));
    }

    public function tagPosts($name)
    {
        $query = $name;
        $tags = Tag::where('name', 'like', "%$name%")->paginate(10);
        $tags->appends(['search' => $name]);

        return view('tagPosts', compact('tags', 'query'));
    }
    public function likePost($post){
        // Check if user already liked the post or not
        $user = Auth::user();
        $likePost = $user->likedPosts()->where('post_id', $post)->count();
        if($likePost == 0){
            $user->likedPosts()->attach($post);
        } else{
            $user->likedPosts()->detach($post);
        }
        return redirect()->back();
    }
}
