<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Test extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'subject_id',
        'chapter_id',
        'title',
        'total_marks',
        'duration'
    ];

    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function mcqSubmissions()
    {
        return $this->hasMany(McqSubmission::class);
    }

    public function mcqResults()
    {
        return $this->hasMany(McqResults::class);
    }

    public function questions()
    {
        return $this->belongsToMany(Question::class, 'test_question');
    }
}
