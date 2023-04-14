<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use App\Models\Announcement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AnnouncementController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    if ($request->ajax()) {
      $keywords = $request->keywords;
      $collection = Announcement::where('title', 'like', '%' . $keywords . '%')
        ->paginate(10);
      return view('page.admin.announcement.list', compact('collection'));
    }
    return view('page.admin.announcement.main');
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('page.admin.announcement.input', ['announcement' => new Announcement()]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'title' => 'required|max:50|min:10',
      'description' => 'required|min:10',
      'image' => 'file|image|mimes:jpeg,png,jpg,svg',
    ]);

    if ($validator->fails()) {
      $errors = $validator->errors();
      if ($errors->has('title')) {
        return response()->json([
          'alert' => 'error',
          'message' => $errors->first('title'),
        ]);
      } elseif ($errors->has('description')) {
        return response()->json([
          'alert' => 'error',
          'message' => $errors->first('description'),
        ]);
      } elseif ($errors->has('image')) {
        return response()->json([
          'alert' => 'error',
          'message' => $errors->first('image'),
        ]);
      }
    }

    if ($request->file('image')) {
      $file = $request->file('image');
      $filename = time() . '.' . $file->getClientOriginalExtension();
      $destinationPath = public_path('/assets/announcement-image');
      $file->move($destinationPath, $filename);

      $announcement = new Announcement();
      $announcement->title = Str::title($request->title);
      $announcement->description = $request->description;
      $announcement->image = $filename;
      $announcement->created_by = Auth::user()->id;
    } else {
      $announcement = new Announcement();
      $announcement->title = Str::title($request->title);
      $announcement->description = $request->description;
      $announcement->created_by = Auth::user()->id;
    }

    $announcement->save();
    return response()->json([
      'alert' => 'success',
      'message' => 'Pengumuman ' . $request->title . ' tersimpan',
    ]);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Announcement  $announcement
   * @return \Illuminate\Http\Response
   */
  public function show(Announcement $announcement)
  {
    return view('page.admin.announcement.show', ['announcement' => $announcement]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Announcement  $announcement
   * @return \Illuminate\Http\Response
   */
  public function edit(Announcement $announcement)
  {
    return view('page.admin.announcement.input', compact('announcement'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Announcement  $announcement
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Announcement $announcement)
  {
    $validator = Validator::make($request->all(), [
      'title' => 'required|max:50|min:10',
      'description' => 'required|min:10',
      'image' => 'file|image|mimes:jpeg,png,jpg,svg',
    ]);

    if ($validator->fails()) {
      $errors = $validator->errors();
      if ($errors->has('title')) {
        return response()->json([
          'alert' => 'error',
          'message' => $errors->first('title'),
        ]);
      } elseif ($errors->has('description')) {
        return response()->json([
          'alert' => 'error',
          'message' => $errors->first('description'),
        ]);
      } elseif ($errors->has('image')) {
        return response()->json([
          'alert' => 'error',
          'message' => $errors->first('image'),
        ]);
      }
    }

    $destinationPath = public_path('/assets/announcement-image');

    if ($request->file('image')) {
      if ($announcement->image != 'default-image-post.svg') {
        unlink($destinationPath . '/' . $announcement->image);
      }
      $file = $request->file('image');
      $filename = time() . '.' . $file->getClientOriginalExtension();
      $file->move($destinationPath, $filename);
    } else {
      $filename = $request->old_image;
    }

    $announcement->title = Str::title($request->title);
    $announcement->description = $request->description;
    $announcement->image = $filename;
    $announcement->update();
    return response()->json([
      'alert' => 'success',
      'message' => 'Pengumuman ' . $request->title . ' tersimpan',
    ]);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Announcement  $announcement
   * @return \Illuminate\Http\Response
   */
  public function destroy(Announcement $announcement)
  {
    if ($announcement->image != 'default-image-post.svg') {
      $destinationPath = public_path('/assets/announcement-image');
      unlink($destinationPath . '/' . $announcement->image);
    }

    $announcement->delete();
    return response()->json([
      'alert' => 'success',
      'message' => 'Pelajaran ' . $announcement->title . ' terhapus',
    ]);
  }
}
