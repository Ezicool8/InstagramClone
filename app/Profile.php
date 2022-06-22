<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = [];

    public function profileImage()
    {
        $imagePath = ($this->image) ? $this->image : 'profile/6HOMfvBaPiVwiLRjp4I9OfMivfexpACDA5SuGe4L.jpg';
        return '/storage/'. $imagePath;
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function posts()
    {
        return $this->hasMany(Post::class)->orderBy('created_at', 'DESC');
    }
    
    public function followers(){
        return $this->belongsToMany(User::class);
    }
}
