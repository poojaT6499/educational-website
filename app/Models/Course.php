<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Eloquent;

class Course extends Model
{

    protected $table = 'course';
    public $timestamps = false;
    protected $primaryKey = 'CourseID';

    public function livemeetings()
    {
        return $this->hasMany(livemeetings::class, 'meetingID');
    }
}
