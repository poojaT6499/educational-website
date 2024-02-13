<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use SoftDeletes;
    // constants
    const WRITTEN = 0, MCQ = 1;

    protected $fillable = [
        'chapter_id',
        'name',
        'marks',
        'type',
        'difficulty_level',
        'status'
    ];

    // protected $table = 'question';
    // public $timestamps = false;
    // protected $primaryKey = 'questionID';

    public function isMcq()
    {
        return $this->type === Question::MCQ;
    }

    public function isWritten()
    {
        return $this->type === Question::WRITTEN;
    }

    public function answer()
    {
        return $this->belongsTo(answer::class, 'answerID');
    }

    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }

    public function options()
    {
        return $this->hasMany(Option::class);
    }

    public function tests()
    {
        return $this->belongsToMany(Test::class, 'test_question');
    }
}
