<?php

namespace App\Http\Controllers\Siswa;

use App\Models\Log;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
  public function index()
  {

    $collection = Announcement::orderBy('created_at', 'DESC')->paginate(5);
    // data kelas X
    $kelas_x = Log::select('*')->join('rooms', 'logs.class_id', '=', 'rooms.id')->groupBy('class_id')->where('logs.created_at', 'LIKE', date('Y-m-d', strtotime(today())) . '%')->where('rooms.nama_kelas', 'LIKE', 'X IP%')->get();
    $kelas_x_count = Log::select(DB::raw('COUNT(class_id) as c'))->join('rooms', 'logs.class_id', '=', 'rooms.id')->groupBy('class_id')->where('logs.created_at', 'LIKE', date('Y-m-d', strtotime(today())) . '%')->where('rooms.nama_kelas', 'LIKE', 'X IP%')->get();

    // data kelas XI
    $kelas_xi = Log::select('*')->join('rooms', 'logs.class_id', '=', 'rooms.id')->groupBy('class_id')->where('logs.created_at', 'LIKE', date('Y-m-d', strtotime(today())) . '%')->where('rooms.nama_kelas', 'LIKE', 'XI IP%')->get();
    $kelas_xi_count = Log::select(DB::raw('COUNT(class_id) as c'))->join('rooms', 'logs.class_id', '=', 'rooms.id')->groupBy('class_id')->where('logs.created_at', 'LIKE', date('Y-m-d', strtotime(today())) . '%')->where('rooms.nama_kelas', 'LIKE', 'XI IP%')->get();

    // data kelas XI
    $kelas_xii = Log::select('*')->join('rooms', 'logs.class_id', '=', 'rooms.id')->groupBy('class_id')->where('logs.created_at', 'LIKE', date('Y-m-d', strtotime(today())) . '%')->where('rooms.nama_kelas', 'LIKE', 'XII IP%')->get();
    $kelas_xii_count = Log::select(DB::raw('COUNT(class_id) as c'))->join('rooms', 'logs.class_id', '=', 'rooms.id')->groupBy('class_id')->where('logs.created_at', 'LIKE', date('Y-m-d', strtotime(today())) . '%')->where('rooms.nama_kelas', 'LIKE', 'XII IP%')->get();
    // dd($kelas_x_count);

    return view('page.siswa.dashboard.main', [
      'announcements' => $collection,
      'kelas_x' => $kelas_x,
      'kelas_x_count' => $kelas_x_count,
      'kelas_xi' => $kelas_xi,
      'kelas_xi_count' => $kelas_xi_count,
      'kelas_xii' => $kelas_xii,
      'kelas_xii_count' => $kelas_xii_count,
    ]);
  }
}
