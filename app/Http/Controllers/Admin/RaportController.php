<?php

namespace App\Http\Controllers\Admin;

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
      $collection = Raport::select(DB::raw("*, raport.id as raport_id"))
        ->leftJoin('courses', 'raport.courses_id', '=', 'courses.id')
        ->leftJoin('users', 'raport.siswa_id', '=', 'users.id')
        ->where('users.name', 'like', '%' . $keywords . '%')
        ->paginate(10);
      return view('page.admin.raport.list', compact('collection'));
    }

    return view('page.admin.raport.main');
  }

  public function generatePDF($id)
  {
    $data_siswa = Raport::where('id', $id)->first();
    $raport = Raport::where('siswa_id', $data_siswa->siswa_id)->get();
    $data = ['title' => 'Raport', 'raport' => $raport, 'data_siswa' => $data_siswa];
    $pdf = PDF::loadView('page.admin.raport.pdf', $data);
    return $pdf->download($data_siswa->student->name . '_raport_' . $data_siswa->student->class->nama_kelas . '.pdf');
  }
}
