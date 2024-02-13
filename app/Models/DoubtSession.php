<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DoubtSession extends Model
{
    use HasFactory, SoftDeletes;

    // costants
    const DOUBT_SESSION = 0, LIVE_SESSION = 1; //default doubt_session i.e. 0 

    protected $fillable = [
        'teacher_id',
        'chapter_id',
        'title',
        'link',
        'schedule_time',
        'platform',
        'type'
    ];

    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
