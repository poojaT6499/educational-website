<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Option extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'question_id',
        'option',
        'is_correct'
    ];

    public function isCorrect()
    {
        return $this->is_correct == 1;
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
