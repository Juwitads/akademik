<?php

namespace App\Http\Controllers\Siswa;

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
      return view('page.siswa.announcement.list', compact('collection'));
    }
    return view('page.siswa.announcement.main');
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Announcement  $announcement
   * @return \Illuminate\Http\Response
   */
  public function show(Announcement $announcement)
  {
    return view('page.siswa.announcement.show', ['announcement' => $announcement]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Announcement  $announcement
   * @return \Illuminate\Http\Response
   */
  public function edit(Announcement $announcement)
  {
    //
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
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Announcement  $announcement
   * @return \Illuminate\Http\Response
   */
  public function destroy(Announcement $announcement)
  {
    //
  }
}
