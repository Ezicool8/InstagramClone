<?php

namespace App\Http\Controllers;
use App\User;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Cache;

use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    //
    public function index(User $user)
    {
        $follows = (auth()->user())  ? auth()->user()->following->contains($user->id) : false;
        
        $postCount = Cache::remember(
            'count.posts.' .$user->id,
            now()->addSeconds(30),
            function() use ($user) {
                return $user->posts->count();
            });

        $followersCount = Cache::remember(
            'count.followers.' .$user->id,
            now()->addSeconds(30),
            function() use ($user) {
                return $user->profile->followers->count();
            });

        $followingCount = Cache::remember(
            'count.following.' .$user->id,
            now()->addSeconds(30),
            function() use ($user) {
                return $user->following->count();
            });
        
        return view('profiles.index', compact('user', 'follows', 'postCount', 'followersCount', 'followingCount'));
    
    }

    public function edit(User $user){
        $this-> authorize('update', $user->profile);
        return view('profiles.edit', compact('user'));
    }

    public function update (User $user){

        $this-> authorize('update', $user->profile);

        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => '',
            'image' => '',
        ]);
        if (request('image')){
            $image_path= request('image')->store('profile', 'public');
            $image = Image::make(public_path("storage/{$image_path}"))->fit(1000, 1000);
            $image->save();

            $imageArray = ['image' => $image_path];
        }
        auth()->user()->profile->update(array_merge(
            $data,
            $imageArray ?? []
            ));
            //if $imageArray not set then default to an emplty array

        return redirect('/profile/' . auth()->user()->id );

    }
}
