<?php

namespace App\Http\Controllers\Guru;

use PDF;
use App\Models\Room;
use App\Models\Task;
use App\Models\User;
use App\Models\Course;
use App\Models\Raport;
use App\Models\Progress;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class RaportController extends Controller
{
  public function index(Request $request)
  {
    if ($request->ajax()) {
      $keywords = $request->keywords;
      $collection = Raport::select(DB::raw("*, raport.id as raport_id
      "))
        ->leftJoin('courses', 'raport.courses_id', '=', 'courses.id')
        ->leftJoin('users', 'raport.siswa_id', '=', 'users.id')
        ->where('users.name', 'like', '%' . $keywords . '%')
        ->paginate(10);
      return view('page.guru.raport.list', compact('collection'));
    }

    return view('page.guru.raport.main');
  }
  public function create()
  {
    $token = Auth::user()->id;
    $course = Course::where('guru_id', $token)->get();
    $task = Task::get();
    $user = User::where('role', 's')->orderBy('class_id', 'asc')->orderBy('name', 'asc')->get();
    return view('page.guru.raport.input', ['raport' => new Raport, 'course' => $course, 'user' => $user, 'task' => $task]);
  }
  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'courses_id' => 'required',
      'siswa_id' => 'required',
      'kehadiran' => 'required',
      'tugas' => 'required',
      'uts' => 'required',
      'uas' => 'required',
      'kkm' => 'required',
      'nilai_akhir' => 'required',
    ]);

    if ($validator->fails()) {
      $errors = $validator->errors();
      if ($errors->has('courses_id')) {
        return response()->json([
          'alert' => 'error',
          'message' => $errors->first('courses_id'),
        ]);
      } elseif ($errors->has('kelas_id')) {
        return response()->json([
          'alert' => 'error',
          'message' => $errors->first('kelas_id'),
        ]);
      } elseif ($errors->has('siswa_id')) {
        return response()->json([
          'alert' => 'error',
          'message' => $errors->first('siswa_id'),
        ]);
      } elseif ($errors->has('kehadiran')) {
        return response()->json([
          'alert' => 'error',
          'message' => $errors->first('kehadiran'),
        ]);
      } elseif ($errors->has('uts')) {
        return response()->json([
          'alert' => 'error',
          'message' => $errors->first('uts'),
        ]);
      } elseif ($errors->has('uas')) {
        return response()->json([
          'alert' => 'error',
          'message' => $errors->first('uas'),
        ]);
      } elseif ($errors->has('kkm')) {
        return response()->json([
          'alert' => 'error',
          'message' => $errors->first('kkm'),
        ]);
      } elseif ($errors->has('nilai_akhir')) {
        return response()->json([
          'alert' => 'error',
          'message' => $errors->first('nilai_akhir'),
        ]);
      } else {
        return response()->json([
          'alert' => 'error',
          'message' => $errors->first('tugas'),
        ]);
      }
    }
    $task = new Raport;
    $task->courses_id = $request->courses_id;
    $task->siswa_id = $request->siswa_id;
    $task->kehadiran = $request->kehadiran;
    $task->tugas = $request->tugas;
    $task->uts = $request->uts;
    $task->uas = $request->uas;
    $task->nilai_akhir = $request->nilai_akhir;
    $task->kkm = $request->kkm;
    $task->created_at = date('Y-m-d H:i:s');
    $task->save();
    return response()->json([
      'alert' => 'success',
      'message' => 'Data Raport ' . $request->title . ' tersimpan',
    ]);
  }
  public function edit(Raport $raport)
  {
    $token = Auth::user()->id;
    $course = Course::where('guru_id', $token)->get();
    $task = Task::get();
    $user = User::where('role', 's')->get();
    return view('page.guru.raport.input', ['task' => $task, 'course' => $course, 'user' => $user, 'raport' => $raport]);
  }

  public function update(Request $request, Raport $raport)
  {
    $validator = Validator::make($request->all(), [
      'kehadiran' => 'required',
      'tugas' => 'required',
      'uts' => 'required',
      'uas' => 'required',
      'kkm' => 'required',
      'nilai_akhir' => 'required',
    ]);

    if ($validator->fails()) {
      $errors = $validator->errors();
      if ($errors->has('kehadiran')) {
        return response()->json([
          'alert' => 'error',
          'message' => $errors->first('kehadiran'),
        ]);
      } elseif ($errors->has('tugas')) {
        return response()->json([
          'alert' => 'error',
          'message' => $errors->first('tugas'),
        ]);
      } elseif ($errors->has('uts')) {
        return response()->json([
          'alert' => 'error',
          'message' => $errors->first('uts'),
        ]);
      } elseif ($errors->has('kkm')) {
        return response()->json([
          'alert' => 'error',
          'message' => $errors->first('kkm'),
        ]);
      } elseif ($errors->has('nilai_akhir')) {
        return response()->json([
          'alert' => 'error',
          'message' => $errors->first('nilai_akhir'),
        ]);
      } else {
        return response()->json([
          'alert' => 'error',
          'message' => $errors->first('uas'),
        ]);
      }
    }

    $raport->courses_id = $request->courses_id;
    $raport->siswa_id = $request->siswa_id;
    $raport->kehadiran = $request->kehadiran;
    $raport->tugas = $request->tugas;
    $raport->uts = $request->uts;
    $raport->uas = $request->uas;
    $raport->nilai_akhir = $request->nilai_akhir;
    $raport->kkm = $request->kkm;
    $raport->created_at = date('Y-m-d H:i:s');
    $raport->update();
    return response()->json([
      'alert' => 'success',
      'message' => 'Data Raport ' . $request->title . ' terupdate',
    ]);
  }

  public function destroy(Raport $raport)
  {
    $raport->delete();
    return response()->json([
      'alert' => 'success',
      'message' => 'Data Raport ' . $raport->title . ' terhapus',
    ]);
  }
  public function generatePDF($id)
  {
    $data_siswa = Raport::where('id', $id)->first();
    $raport = Raport::where('siswa_id', $data_siswa->siswa_id)->get();
    $data = ['title' => 'Raport', 'raport' => $raport, 'data_siswa' => $data_siswa];
    $pdf = PDF::loadView('page.guru.raport.pdf', $data);
    return $pdf->download($data_siswa->student->name . '_raport_' . $data_siswa->student->class->nama_kelas . '.pdf');
  }
}
