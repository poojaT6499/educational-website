<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\SoftDeletes;

class Media extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'subject_id',
        'chapter_id',
        'media_type',
        'media_url',
        'title',
        'is_demo'
    ];

    protected $table = 'medias';
    // public $timestamps = false;
    protected $primaryKey = 'id';

    public function chapter()
    {
        return $this->belongsTo(Media::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function user()
    {
        return $this->belongsToMany(User::class, 'media_user');
    }

    public function deleteVideo()
    {
        // $file = public_path('assets/admin/media/chapters/videos/'.);
        $video = File::delete($this->media_url);
    }
}
