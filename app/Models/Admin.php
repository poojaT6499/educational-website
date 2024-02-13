<?php

namespace App\Models;

// use App\Http\Controllers\auth\AdminAuthController as Authenticatable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use DB;
use Eloquent;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $guard = 'webadmin';
    protected $table = 'admin';
    // protected $fillable = [
    //     'email',
    //     'password',
    //     'createdAt',
    //     'createdAt',
    //     'deletedAt',
    //     'updatedAt',
        
    // ];

    public $timestamps = false;
    protected $primaryKey = 'adminID';

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
