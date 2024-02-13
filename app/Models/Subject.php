<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'class_id',
        'name',
        'status'
    ];

    /* relations */

    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }

    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'teacher_subject');
    }

    public function tests()
    {
        return $this->hasMany(Test::class);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function medias()
    {
        return $this->hasMany(Media::class);
    }
}
