<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    // Constants
    const ADMIN = 0, TEACHER = 1, STUDENT = 2;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'phone',
        'password',
        'role'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /* relations */

    public function isAdmin()
    {
        return $this->role === User::ADMIN;
    }
    public function isTeacher()
    {
        return $this->role === User::TEACHER;
    }

    public function isStudent()
    {
        return $this->role === User::STUDENT;
    }

    public function classes()
    {
        return $this->hasMany(Classes::class);
    }

    public function medias()
    {
        return $this->belongsToMany(Media::class, 'media_user');
    }

    public function mcqResult()
    {
        return $this->hasOne(McqResults::class);
    }

    public function writtenResult()
    {
        return $this->hasOne(WrittenResults::class);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function writtenSubmission()
    {
        return $this->hasOne(WrittenSubmission::class);
    }

    public function mcqSubmission()
    {
        return $this->hasOne(McqSubmission::class);
    }
}
