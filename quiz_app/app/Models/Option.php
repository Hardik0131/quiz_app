<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_id',
        'option_a',
        'option_b',
        'option_c',
        'option_d',
        'desc',
    ];

    public function question(){
        return $this->belongsTo(Question::class);
    }
}
