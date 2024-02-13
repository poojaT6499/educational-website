<?php

namespace App\Http\Controllers\admin;

use App\Models\Plan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;

class PlanController extends Controller
{
  public function index()
  {
    $data['plan'] = Plan::orderBy('createdAt', 'desc')->get();
    return view('admin.plan.index', $data);
  }
  public function add()
  {
    return view('admin.plan.add');
  }
  public function addPost()
  {
    $plan_data = array(
      'months' => Request::get('months'),
      'amount' => Request::get('amount'),
      'status' => 1,
    );

    $plan_id = Plan::insert($plan_data);
    return redirect()->route('plan')->with('message', 'plan successfully added');
  }
  public function delete($id)
  {
    $plan = Plan::find($id);
    $plan->delete();
    return redirect()->route('plan')->with('message', 'plan deleted successfully.');
  }
  public function edit($id)
  {
    $data['plan'] = Plan::find($id);
    return view('admin.plan.edit', $data);
  }
  public function editPost()
  {
    $id = Request::get('planID');

    $plan = Plan::find($id);

    $plan_data = array(
      'months' => Request::get('months'),
      'amount' => Request::get('amount'),
    );
    $plan_id = Plan::where('planID', '=', $id)->update($plan_data);
    return redirect()->route('plan')->with('message', 'plan Updated successfully');
  }


  public function changeStatus($id)
  {
    $plan = Plan::find($id);
    $plan->status = !$plan->status;
    $plan->save();
    return redirect()->route('plan')->with('message', 'Change plan status successfully');
  }
}
