<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'post_id',
        'slug',
        'level',
        'image',
        'min_score',
        'max_score',
        'title',
        'desc',
    ];

    public function post(){
        return $this->belongsTo(Post::class);
    }
    
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function getRouteKeyName(){
        return 'slug';
    }
}
