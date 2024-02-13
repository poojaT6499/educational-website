<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Eloquent;

class QuestionAndAnswer extends Model
{

    protected $table = 'question&answer';
    public $timestamps = false;
    protected $primaryKey = 'questionAnswerID';
}
