<?php

namespace App\Http\Controllers\admin;

use App\Models\Notification;
use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Teacher;
use Illuminate\Http\Request;

class NotificationController extends Controller
{

  /* Our Code */

  public function index() {
    $notifications = Notification::all();
    // return view('admin-views.Notification.index', compact('Notifications'));
    return $notifications;

    // return view('admin.Notifications', compact([
    //     'Notifications'
    // ]));
  }

  public function create()
  {
      $subjects = Teacher::all();
      $chapters = Classes::all();
  }

  public function store(Request $request)
  {
    $notification = Notification::create([
        'teacher_id'=>$request->teacher_id,
        'classes_id'=>$request->classes_id,
        'message'=>$request->message
    ]);

      return $notification;
      // session()->flash('success', 'Category Added successfully!');
      // return redirect(route('categories.index'));
  }

    public function destroy(Notification $notification)
    {
        $notification->delete();
        // session()->flash('success', 'Notification Deleted Successfully!');
        // return redirect(route('categories.index'));
    }

    public function restore($id)
    {
        // $notification = Notification::find($id);
        // Notification::withTrashed()->$notification->restore();

        Notification::withTrashed()->find($id)->restore();
        return redirect()->back();
    }
    /* Our Code ENDED*/
  /*
  public function index()
  {
    $data['notification'] = Notification::orderBy('createdAt', 'desc')->get();
    return view('admin.notification.index', $data);
  }
  public function add()
  {
    return view('admin.notification.add');
  }
  public function addPost()
  {
    $notification_data = array(
      'notificationTitle' => Request::get('notificationTitle'),
      'date' => Request::get('date'),
      'time' => Request::get('time'),
      'status' => 1,
    );

    $notification_id = Notification::insert($notification_data);
    return redirect()->route('notification')->with('message', 'notification successfully added');
  }
  public function delete($id)
  {
    $notification = Notification::find($id);
    $notification->delete();
    return redirect()->route('notification')->with('message', 'notification deleted successfully.');
  }
  public function edit($id)
  {
    $data['notification'] = Notification::find($id);
    return view('admin.notification.edit', $data);
  }
  public function editPost()
  {
    $id = Request::get('notificationID');

    $class = Notification::find($id);

    $class_data = array(
      'notificationTitle' => Request::get('notificationTitle'),
      'date' => Request::get('date'),
      'time' => Request::get('time'),
    );
    $notification_id = Notification::where('notificationID', '=', $id)->update($class_data);
    return redirect()->route('notification')->with('message', 'notification Updated successfully');
  }


  public function changeStatus($id)
  {
    $notification = Notification::find($id);
    $notification->status = !$notification->status;
    $notification->save();
    return redirect()->route('notification')->with('message', 'Change notification status successfully');
  }
  */
}
