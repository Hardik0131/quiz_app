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
        'post_id',
        'image',
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

    public function options(){
        return $this->hasOne(Option::class);
    }

}
