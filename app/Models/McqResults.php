<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class McqResults extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'test_id',
        'mcq_submission_id',
        'marks_obtained'
    ];

    public function mcqSubmission()
    {
        return $this->belongsTo(McqSubmission::class);
    }

    public function test()
    {
        return $this->belongsTo(Test::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
