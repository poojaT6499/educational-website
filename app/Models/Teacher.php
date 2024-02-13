<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id'
    ];

    /* relations */

    public function classes()
    {
        return $this->belongsToMany(Classes::class, 'teacher_class');
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'teacher_subject');
    }

    public function notes()
    {
        return $this->hasMany(Notes::class);
    }

    public function doubtSessions()
    {
        return $this->hasMany(DoubtSession::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }


}
