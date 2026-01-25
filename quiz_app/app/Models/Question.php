<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Option;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'category_id',
        'slug',
        'post_id',
        'image',
        'a_val',
        'b_val',
        'c_val',
        'd_val',
        'option_a',
        'option_b',
        'option_c',
        'option_d',
        'desc'
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function post(){
        return $this->belongsTo(Post::class);
    }

    public function getRouteKeyName(){
        return 'slug';
    }
}
