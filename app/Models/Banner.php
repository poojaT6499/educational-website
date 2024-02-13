<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Eloquent;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banner extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'image',
        'name',
        'order',
        'status'
    ];

    public function deleteImage()
    {
        $file = public_path('assets/admin/images/banners/'.$this->image);
        $img = File::delete($file);
    }

}
