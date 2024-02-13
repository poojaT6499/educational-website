<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Eloquent;

class LiveMeetings extends Model
{

    protected $table = 'livemeetings';
    public $timestamps = false;
    protected $primaryKey = 'meetingID';


    public function course()
    {
        return $this->belongsTo(course::class, 'CourseID');
    }

    public function classes()
    {
        return $this->belongsTo(classes::class, 'ClassID');
    }
}
