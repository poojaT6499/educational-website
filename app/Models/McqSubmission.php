<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class McqSubmission extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'class_id',
        'test_id',
        'question_id',
        'option_id'
    ];

    public function test()
    {
        return $this->belongsTo(Test::class);
    }

    public function mcqResult()
    {
        return $this->hasOne(McqResults::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
