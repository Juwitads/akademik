<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Course;
use App\Models\Room;
use App\Models\Schedule;
use App\Models\Task;
use App\Models\Progress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ScheduleController extends Controller
{
  public function index(Request $request)
  {
    if ($request->ajax()) {
      $token = Auth::user()->id;
      $start = $request->start;
      $end = $request->end;
      $collection = Schedule::select(DB::raw("schedules.id, schedules.course_id, schedules.class_id, schedules.start_at, schedules.end_at, schedules.url,
            rooms.nama_kelas AS nama_kelas, rooms.tahun_masuk, courses.nama_course AS nama_pelajaran, courses.description
            "))
        ->leftJoin('rooms', 'schedules.class_id', '=', 'rooms.id')
        ->leftJoin('courses', 'schedules.course_id', '=', 'courses.id')
        ->leftJoin('users', 'courses.guru_id', '=', 'users.id')
        ->where('courses.guru_id', $token)
        ->whereBetween(DB::raw('date(schedules.start_at)'), [$start, $end])
        ->paginate(10);

      // Your Eloquent query executed by using get()
      return view('page.guru.schedule.list', compact('collection'));
    }
    return view('page.guru.schedule.main');
  }
  public function create()
  {
    $token = Auth::user()->id;
    $course = Course::where('guru_id', $token)->get();
    $kelas = Room::all();
    // dd($kelas);
    return view('page.guru.schedule.input', ['schedule' => new Schedule, 'course' => $course, 'kelas' => $kelas]);
  }
  public function store(Request $request)
  {
    if ($request->hasFile('file')) {
      $validator = Validator::make($request->all(), [
        'pelajaran' => 'required',
        'kelas' => 'required',
        'url' => 'required',
        'tanggal' => 'required',
        'mulai' => 'required',
        'selesai' => 'required',
        'title' => 'required|max:50|min:10',
        'description' => 'required|max:500',
        'due' => 'required|date_format:"Y-m-d h:i"',
        'file'  => 'file|mimes:pdf,doc,docx,ppt,jpg,png,jpeg|max:2048'
      ]);
    } else {
      $validator = Validator::make($request->all(), [
        'pelajaran' => 'required',
        'kelas' => 'required',
        'url' => 'required',
        'tanggal' => 'required',
        'mulai' => 'required',
        'selesai' => 'required',
      ]);
    }

    if ($validator->fails()) {
      $errors = $validator->errors();
      if ($errors->has('pelajaran')) {
        return response()->json([
          'alert' => 'error',
          'message' => $errors->first('pelajaran'),
        ]);
      } elseif ($errors->has('kelas')) {
        return response()->json([
          'alert' => 'error',
          'message' => $errors->first('kelas'),
        ]);
      } elseif ($errors->has('url')) {
        return response()->json([
          'alert' => 'error',
          'message' => $errors->first('url'),
        ]);
      } elseif ($errors->has('tanggal')) {
        return response()->json([
          'alert' => 'error',
          'message' => $errors->first('tanggal'),
        ]);
      } elseif ($errors->has('mulai')) {
        return response()->json([
          'alert' => 'error',
          'message' => $errors->first('mulai'),
        ]);
      } elseif ($errors->has('selesai')) {
        return response()->json([
          'alert' => 'error',
          'message' => $errors->first('selesai'),
        ]);
      } elseif ($errors->has('title')) {
        return response()->json([
          'alert' => 'error',
          'message' => $errors->first('title'),
        ]);
      } elseif ($errors->has('description')) {
        return response()->json([
          'alert' => 'error',
          'message' => $errors->first('description'),
        ]);
      } elseif ($errors->has('due')) {
        return response()->json([
          'alert' => 'error',
          'message' => $errors->first('due'),
        ]);
      } elseif ($errors->has('file')) {
        return response()->json([
          'alert' => 'error',
          'message' => $errors->first('file'),
        ]);
      }
    }

    $tanggal = $request->tanggal;
    $start = $tanggal . ' ' . $request->mulai;
    $end = $tanggal . ' ' . $request->selesai;

    $cek = Schedule::where("course_id", $request->pelajaran)
      ->where('class_id', $request->kelas)
      ->where('end_at', '>', $start)
      ->where('start_at', '<', $end)
      ->get()->count();

    if ($cek > 0) {
      return response()->json([
        'alert' => 'info',
        'message' => 'Pelajaran ini pada Tanggal ' . $request->tanggal . ' jam ' . $request->mulai . ' sampai jam ' . $request->selesai . ' sudah terjadwal',
      ]);
    }

    $url = '';
    $parsed = parse_url($request->url);
    if (empty($parsed['scheme'])) {
      $url .= 'http://' . ltrim($request->url, '/');
    } else {
      $url .= $request->url;
    }

    $schedule = new Schedule;
    $schedule->course_id = $request->pelajaran;
    $schedule->class_id = $request->kelas;
    $schedule->start_at = $start;
    $schedule->end_at = $end;
    $schedule->url = $url;
    $schedule->save();

    if ($request->hasFile('file')) {
      $file = request()->file('file')->store("task");
      $task = new Task;
      $task->title = Str::title($request->title);
      $task->description = Str::title($request->description);
      $task->schedule_id = $schedule->id;
      $task->due_at = $request->due;
      $task->file = $file;
      $task->save();
    }
    return response()->json([
      'alert' => 'success',
      'message' => 'Jadwal tersimpan',
    ]);
  }
  public function show(Schedule $schedule)
  {
    //
  }

  public function edit(Schedule $schedule)
  {
    $token = Auth::user()->id;
    $course = Course::where('guru_id', $token)->get();
    $task = Task::where('schedule_id', $schedule->id)->first();
    // dd("<pre>$task</pre>");
    $kelas = Room::get();
    return view('page.guru.schedule.input', compact('schedule', 'task', 'course', 'kelas'));
  }
  public function update(Request $request, Schedule $schedule)
  {
    if ($request->hasFile('file')) {
      $validator = Validator::make($request->all(), [
        'pelajaran' => 'required',
        'kelas' => 'required',
        'url' => 'required',
        'tanggal' => 'required',
        'mulai' => 'required',
        'selesai' => 'required',
        'title' => 'required|max:50|min:10',
        'description' => 'required|max:500',
        'due' => 'required|date_format:Y-m-d H:i',
        'file'  => 'file|mimes:pdf,doc,docx,ppt,jpg,png,jpeg|max:2048'
      ]);
    } else {
      $validator = Validator::make($request->all(), [
        'pelajaran' => 'required',
        'kelas' => 'required',
        'url' => 'required',
        'tanggal' => 'required',
        'mulai' => 'required',
        'selesai' => 'required',
      ]);
    }

    if ($validator->fails()) {
      $errors = $validator->errors();
      if ($errors->has('pelajaran')) {
        return response()->json([
          'alert' => 'error',
          'message' => $errors->first('pelajaran'),
        ]);
      } elseif ($errors->has('kelas')) {
        return response()->json([
          'alert' => 'error',
          'message' => $errors->first('kelas'),
        ]);
      } elseif ($errors->has('url')) {
        return response()->json([
          'alert' => 'error',
          'message' => $errors->first('url'),
        ]);
      } elseif ($errors->has('tanggal')) {
        return response()->json([
          'alert' => 'error',
          'message' => $errors->first('tanggal'),
        ]);
      } elseif ($errors->has('mulai')) {
        return response()->json([
          'alert' => 'error',
          'message' => $errors->first('mulai'),
        ]);
      } elseif ($errors->has('selesai')) {
        return response()->json([
          'alert' => 'error',
          'message' => $errors->first('selesai'),
        ]);
      } elseif ($errors->has('title')) {
        return response()->json([
          'alert' => 'error',
          'message' => $errors->first('title'),
        ]);
      } elseif ($errors->has('description')) {
        return response()->json([
          'alert' => 'error',
          'message' => $errors->first('description'),
        ]);
      } elseif ($errors->has('due')) {
        return response()->json([
          'alert' => 'error',
          'message' => $errors->first('due'),
        ]);
      } elseif ($errors->has('file')) {
        return response()->json([
          'alert' => 'error',
          'message' => $errors->first('file'),
        ]);
      }
    }

    $tanggal = $request->tanggal;
    $start = $tanggal . ' ' . $request->mulai;
    $end = $tanggal . ' ' . $request->selesai;
    $cek = Schedule::where("course_id", $request->pelajaran)
      ->where('class_id', $request->kelas)
      ->where('end_at', '>', $start)
      ->where('start_at', '<', $end)
      ->first();

    if ($cek->count() > 0) {
      if ($cek->start_at == $request->mulai && $cek->course_id == $request->pelajaran) {
        return response()->json([
          'alert' => 'info',
          'message' => 'Pelajaran ini pada Tanggal ' . $request->tanggal . ' jam ' . $request->mulai . ' sampai jam ' . $request->selesai . ' sudah terjadwal',
        ]);
      }
    }

    $url = '';
    $parsed = parse_url($request->url);
    if (empty($parsed['scheme'])) {
      $url .= 'http://' . ltrim($request->url, '/');
    } else {
      $url .= $request->url;
    }

    $schedule->course_id = $request->pelajaran;
    $schedule->class_id = $request->kelas;
    $schedule->start_at = $start;
    $schedule->end_at = $end;
    $schedule->url = $url;
    $schedule->update();

    $old_task = Task::where('schedule_id', $schedule->id)->first();
    if ($old_task != null) {
      if ($request->hasFile('file')) {
        Storage::delete($old_task->file);
        $file = request()->file('file')->store("task");
      } else {
        $file = $old_task->file;
      }

      $task = [
        'title' => Str::title($request->title),
        'description' => Str::title($request->description),
        'due_at'  => $request->due,
        'file'  => $file,
      ];

      // $task->title = Str::title($request->title);
      // $task->description = Str::title($request->description);
      // $task->due_at = $request->due;
      // $task->file = $file;
      // dd($task);
      Task::where('id', $old_task->id)->update($task);
    } else {
      // dd($request->all());
      if ($request->hasFile('file')) {
        $file = request()->file('file')->store("task");
        $task = new Task;
        $task->title = Str::title($request->title);
        $task->description = Str::title($request->description);
        $task->schedule_id = $schedule->id;
        $task->due_at = $request->due;
        $task->file = $file;
        $task->save();
      }
    }

    return response()->json([
      'alert' => 'success',
      'message' => 'Jadwal terupdate',
    ]);
  }

  public function destroy(Schedule $schedule)
  {
    $old_task = Task::where('schedule_id', $schedule->id)->first();
    if ($old_task != null) {
      Storage::delete($old_task->file);
    }

    $schedule->delete();
    return response()->json([
      'alert' => 'success',
      'message' => 'Jadwal terhapus',
    ]);
  }
  // public function task(Schedule $schedule)
  // {
  //   $task = Task::where('schedule_id', $schedule->id)->first();
  //   if ($task == null) {
  //     $task = new Task;
  //   } else {
  //     $task = $task;
  //   }
  //   return view('page.guru.schedule.task', compact('schedule', 'task'));
  // }
  public function progress(Request $request, Task $task)
  {
    if ($request->ajax()) {
      $keywords = $request->keywords;
      $collection = Progress::where('file', 'like', '%' . $keywords . '%')
        ->paginate(10);
      return view('page.guru.task.list', compact('collection'));
    }
    return view('page.guru.task.progress', compact('task'));
  }
}
