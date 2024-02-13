<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model   {

    use SoftDeletes;

    protected $fillable = [
        'teacher_id',
        'classes_id',
        'message'
    ];

    // protected $table = 'notification';
    // public $timestamps = false;
    // protected $primaryKey = 'notificationID';

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }
    public function class()
    {
        return $this->belongsTo(Classes::class);
    }
  
}