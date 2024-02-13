<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Eloquent;

class Answer extends Model
{

    protected $table = 'answer';
    public $timestamps = false;
    protected $primaryKey = 'answerID';




    public function question()
    {
        return $this->hasOne(question::class, 'questionID');
    }
}
