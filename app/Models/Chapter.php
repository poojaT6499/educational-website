<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chapter extends Model
{

    use SoftDeletes;

    protected $fillable = [
        'subject_id',
        'name',
        'status'
    ];

    // protected $table = 'chapter';
    // public $timestamps = false;
    // protected $primaryKey = 'ChapterID';

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function media()
    {
        return $this->hasMany(Media::class);
    }

    public function tests()
    {
        return $this->hasMany(Test::class);
    }

    public function doubtSessions()
    {
        return $this->hasMany(DoubtSession::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function notes()
    {
        return $this->hasMany(Notes::class);
    }
}
