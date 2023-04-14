<?php

namespace App\Http\Controllers\Siswa;

use App\Models\Log;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
  public function __construct()
  {
    $this->middleware('guest:siswa')->except('do_logout');
  }
  public function index()
  {
    return view('page.siswa.auth.main');
  }
  public function do_login(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'email' => 'required|email|max:255',
      'password' => 'required|min:8',
    ]);

    if ($validator->fails()) {
      $errors = $validator->errors();
      if ($errors->has('email')) {
        return response()->json([
          'alert' => 'error',
          'message' => $errors->first('email'),
        ]);
      } else {
        return response()->json([
          'alert' => 'error',
          'message' => $errors->first('password'),
        ]);
      }
    }
    if (Auth::guard('siswa')->attempt(['email' => $request->email, 'password' => $request->password, 'role' => 's'], $request->remember)) {
      // ambil data user yang melakukan login
      $user_data = User::where('email', $request->email)->get()->first();

      // menyimpan log
      $log_data = Log::where('user_id', $user_data->id)->where('created_at', 'LIKE', date('Y-m-d', strtotime(today())) . '%')->first();
      if ($log_data != NULL) {
        $log_data->created_at = now();
        $log_data->class_id = $user_data->class_id;
        $log_data->update();
      } else {
        Log::create([
          'user_id' => $user_data->id,
          'class_id' => $user_data->class_id,
          'action' => 'login',
        ]);
      }

      return response()->json([
        'alert' => 'success',
        'message' => 'Welcome back ' . Auth::guard('siswa')->user()->name,
      ]);
    } else {
      return response()->json([
        'alert' => 'error',
        'message' => 'Sorry, looks like there are some errors detected, please try again.',
      ]);
    }
  }
  public function do_logout()
  {
    $user = Auth::guard('siswa')->user();
    Auth::logout($user);
    return redirect()->route('siswa.auth.index');
  }
}
