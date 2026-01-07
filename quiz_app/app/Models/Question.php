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
        'post_id',
        'image',
        'desc'
    ];

    public function post(){
        return $this->belongsTo(Post::class);
    }

    public function options(){
        return $this->hasOne(Option::class);
    }

}
