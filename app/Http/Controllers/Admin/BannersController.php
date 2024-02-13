<?php

namespace App\Http\Controllers\admin;

use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;

class BannersController extends Controller
{
    public function index() {
        $banners = Banner::all();
        // return view('admin-views.banner.index', compact('banners'));
        // return $banners;
        return view('admin.banner.index', compact([
            'banners'
        ]));
    }
    public function create()
    {
        // will serve add-Banner page
        return view('admin.banner.create');
    }

    public function store(Request $request)
    {
        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename = time() . '.' . $extension;
            $file->move('assets/admin/images/banners/', $filename);
            $image = $filename;
        } else {
            $image = '';
        }

        if($request->exists('status'))
            $status = $request->status == "on" ? 1 : 0;
        else
            $status = 0;

        $banner = Banner::create([
            'image' => $image,
            'name' => $request->name,
            'order' => $request->order,
            'status' => $status
        ]);

        // return $banner;
        session()->flash('success', 'Banner Added successfully!');
        return redirect(route('admin.banner'));
    }

    public function show()
    {
        //
    }

    public function edit(Banner $banner)
    {
        // will serve edit-Banner page (containing update btn)
        return view('admin.banner.edit', compact([
            'banner'
        ]));
    }

    public function update(Request $request, Banner $banner)
    {
        $image = '';
        if ($request->hasfile('image')) {
            $banner->deleteImage();
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename = time() . '.' . $extension;
            $file->move('assets/admin/images/banners/', $filename);
            $image = $filename;
        } else {
            $image = $banner->image;
        }

        if($request->exists('status'))
            $status = $request->status == "on" ? 1 : 0;
        else
            $status = 0;

        $banner->update([
            'image' => $image,
            'name' => $request->name,
            'order' => $request->order,
            'status' => $status
        ]);

        session()->flash('success', 'Banner Updated Successfully!');
        return redirect(route('admin.banner'));
    }

    public function destroy(Banner $banner)
    {
        $banner->deleteImage();
        $banner->delete();
        session()->flash('success', 'Banner Deleted Successfully!');
        return redirect(route('admin.banner'));
    }

    public function restore($id)
    {
        // $banner = Banner::find($id);
        // Banner::withTrashed()->$banner->restore();
        Banner::withTrashed()->find($id)->restore();
        return redirect()->back();
    }

}
