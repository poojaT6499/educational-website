<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Notification;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{
    /* Our Code */

    public function index() {
        $teacher = Teacher::where('user_id', Auth::user()->id)->first();
        $notifications = Notification::where('teacher_id', $teacher->id)->get();
        // return view('admin-views.Notification.index', compact('Notifications'));
        // return $notifications;
        $classes = $teacher->classes;
        // dd($notifications);
        return view('teacher.notification.index', compact([
            'notifications',
            'classes',
        ]));
    }

    public function create()
    {
        $teacher = Teacher::where('user_id', Auth::user()->id)->first();
        $classes = $teacher->classes;
        return view('teacher.notification.create', compact([
            'classes',
        ]));
    }

    public function store(Request $request)
    {
        $teacher = Teacher::where('user_id', Auth::user()->id)->first();
        $notification = Notification::create([
            'teacher_id' => $teacher->id,
            'classes_id' => $request->class_id,
            'message' => $request->message
        ]);

        return redirect(route('teacher.notification'));

        // return $notification;
        // session()->flash('success', 'Category Added successfully!');
        // return redirect(route('categories.index'));
    }

    public function destroy(Notification $notification)
    {
        $notification->delete();
        return redirect(route('teacher.notification'));
    }

    public function restore($id)
    {
        // $notification = Notification::find($id);
        // Notification::withTrashed()->$notification->restore();

        Notification::withTrashed()->find($id)->restore();
        return redirect()->back();
    }
    /* Our Code ENDED*/
}
