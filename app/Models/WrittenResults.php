<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WrittenResults extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'test_id',
        'written_submission_id',
        'marks_obtained'
    ];

    public function writtenSubmission()
    {
        return $this->belongsTo(writtenSubmission::class);
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
