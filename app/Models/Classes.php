<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class Classes extends Model
{

    use HasApiTokens, SoftDeletes;

    protected $fillable = [
        'name',
        'status'
    ];

    protected $table = 'classes';
    // public $timestamps = false;
    protected $primaryKey = 'id';


    public function livemeetings()
    {
        return $this->hasMany(livemeetings::class, 'meetingID');
    }

    /* relations */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'teacher_class');
    }

    public function subjects()
    {
        return $this->hasMany(Subject::class, 'class_id');
    }
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
}
