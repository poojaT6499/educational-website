<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notes extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'teacher_id',
        'chapter_id',
        'file',
        'type'
    ];

    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function deleteFile()
    {
        // $file = public_path('assets/admin/media/chapters/videos/'.);
        $file = File::delete($this->file);
    }
}
