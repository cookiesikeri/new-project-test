<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $model = \App\Models\Post::class;

    public function definition()
    {
        return [


            'user_id' => 1,
            'category_id'=> random_int(1,8),
            'title' => $this->faker->sentence($nbWords = 10, $variableNbWords = true),
            'slug' => Str::slug($this->faker->sentence($nbWords = 10, $variableNbWords = true)),
            'image' => 'https://cdn.britannica.com/39/7139-050-A88818BB/Himalayan-chocolate-point.jpg',
            'body' => $this->faker->paragraph($nbSentences = 20, $variableNbSentences = true),
            'view_count' => 0,
            'status' => 1
        ];
    }

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\Models\User'); // user_id
    }
    public function category()
    {
        return $this->belongsTo('App\Models\Category'); // category_id
    }
    public function tags()
    {
        return $this->hasMany('App\Models\Tag', 'postID', 'id');
    }
    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    // Define Scope
    // published()
    public function scopePublished($query)
    {
        return $query->where('status', 1);
    }

    // many to many
    public function likedUsers()
    {
        return $this->belongsToMany('App\Models\User')->withTimestamps();
    }
}
