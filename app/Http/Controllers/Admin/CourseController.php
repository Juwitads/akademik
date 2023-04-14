<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class CourseController extends Controller
{
  public function index(Request $request)
  {
    if ($request->ajax()) {
      $keywords = $request->keywords;
      $collection = Course::where('nama_course', 'like', '%' . $keywords . '%')->paginate(10);
      return view('page.admin.course.list', compact('collection'));
    }
    return view('page.admin.course.main');
  }
  public function create()
  {
    $guru = User::where('role', 'g')->get();
    $room = Room::get();
    return view('page.admin.course.input', ['course' => new Course, 'guru' => $guru, 'rooms' => $room]);
  }
  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'nama_course' => 'required',
      'room_id' => 'required',
      'description' => 'required',
      'guru' => 'required',
    ]);

    if ($validator->fails()) {
      $errors = $validator->errors();
      if ($errors->has('nama_course')) {
        return response()->json([
          'alert' => 'error',
          'message' => $errors->first('nama_course'),
        ]);
      } elseif ($errors->has('room_id')) {
        return response()->json([
          'alert' => 'error',
          'message' => $errors->first('room_id'),
        ]);
      } elseif ($errors->has('description')) {
        return response()->json([
          'alert' => 'error',
          'message' => $errors->first('description'),
        ]);
      } elseif ($errors->has('guru')) {
        return response()->json([
          'alert' => 'error',
          'message' => $errors->first('guru'),
        ]);
      }
    }
    $course = new Course;
    $course->nama_course = $request->nama_course;
    $course->room_id = $request->room_id;
    $course->description = $request->description;
    $course->guru_id = $request->guru;
    $course->save();
    return response()->json([
      'alert' => 'success',
      'message' => 'Pelajaran ' . $request->nama_course . ' tersimpan',
    ]);
  }
  public function show(Course $course)
  {
    //
  }
  public function edit(Course $course)
  {
    $guru = User::where('role', 'g')->get();
    $room = Room::get();
    return view('page.admin.course.input', ['course' => $course, 'guru' => $guru, 'rooms' => $room]);
  }
  public function update(Request $request, Course $course)
  {
    $validator = Validator::make($request->all(), [
      'nama_course',
      'room_id',
      'description',
      'guru',
    ]);

    if ($validator->fails()) {
      $errors = $validator->errors();
      if ($errors->has('nama_course')) {
        return response()->json([
          'alert' => 'error',
          'message' => $errors->first('nama_course'),
        ]);
      } elseif ($errors->has('room_id')) {
        return response()->json([
          'alert' => 'error',
          'message' => $errors->first('room_id'),
        ]);
      } elseif ($errors->has('description')) {
        return response()->json([
          'alert' => 'error',
          'message' => $errors->first('description'),
        ]);
      } elseif ($errors->has('guru')) {
        return response()->json([
          'alert' => 'error',
          'message' => $errors->first('guru'),
        ]);
      }
    }
    $course->nama_course = $request->nama_course;
    $course->room_id = $request->room_id;
    $course->description = $request->description;
    $course->guru_id = $request->guru;
    $course->update();
    return response()->json([
      'alert' => 'success',
      'message' => 'Pelajaran ' . $request->nama_course . ' terupdate',
    ]);
  }
  public function destroy(Course $course)
  {
    $course->delete();
    return response()->json([
      'alert' => 'success',
      'message' => 'Pelajaran ' . $course->nama_course . ' terhapus',
    ]);
  }
}
