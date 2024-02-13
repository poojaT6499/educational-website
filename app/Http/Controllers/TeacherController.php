<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    // AJAX
    public function getChaptersofaSubject($subject_id) 
    {
        $chapters = Chapter::where('subject_id', $subject_id)->get();
        return json_encode($chapters);
    }
}
