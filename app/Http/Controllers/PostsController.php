<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Post;
use App\User;

class PostsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(User $user){
        $usersFollowing = auth()->user()->following()->pluck('profiles.user_id');
        $posts = Post::whereIn('user_id', $usersFollowing)->with('user')->latest()->paginate(5);
        
        return view('posts.index', compact('posts'));
    }

    public function create() 
    {
        return view('posts.create');
    }
 
    public function store(Request $request)
    {
         $request->validate([
             'caption' => 'required',
             'image'=> ['required'],
         ]);

         $image_path= request('image')->store('uploads', 'public');
         $image = Image::make(public_path("storage/{$image_path}"))->fit(1200, 1200);
         $image->save();
         
         Post::create([
             'caption'=> $request->input('caption'),
             'image'=> $image_path,
             'user_id' => auth()->user()->id
         ]);
         return redirect('/profile/' . auth()->user()->id );

    }

    public function show(\App\Post $post){
        return view('posts.show', compact('post'));
    }
} 