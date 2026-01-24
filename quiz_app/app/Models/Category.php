<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'short_desc',
        'slug',
        'long_desc'
    ];

    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function questions(){
        return $this->hasMany(Question::class);
    }

    public function results(){
        return $this->hasMany(Result::class);
    }

    public function getRouteKeyName(){
        return 'slug';
    }
}
