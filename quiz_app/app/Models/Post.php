<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_name',
        'slug',
        'category_id',
        'image',
        'desc',
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function questions(){
        return $this->hasMany(Question::class);
    }

    public function results(){
        return $this->hasMany(Result::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
