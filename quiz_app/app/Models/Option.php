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
        'a_val',
        'option_b',
        'b_val',
        'option_c',
        'c_val',
        'option_d',
        'd_val',
        'desc',
    ];

    public function question(){
        return $this->belongsTo(Question::class);
    }
}
