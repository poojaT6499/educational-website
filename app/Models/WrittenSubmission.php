<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WrittenSubmission extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'class_id',
        'test_id',
        'question_id',
        'answer',
        'marks_obtained'
    ];

    public function test()
    {
        return $this->belongsTo(Test::class);
    }

    public function writtenResult()
    {
        return $this->hasOne(WrittenResults::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
