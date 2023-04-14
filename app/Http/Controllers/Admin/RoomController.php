<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $keywords = $request->keywords;
            $collection = Room::where('nama_kelas','like','%'.$keywords.'%')
            ->paginate(10);
            return view('page.admin.class.list', compact('collection'));
        }
        return view('page.admin.class.main');
    }
    public function create()
    {
        return view('page.admin.class.input', ['room' => new Room]);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tingkat_kelas' => 'required',
            'no_kelas' => 'required',
            'jurusan' => 'required',
            'tahun_masuk' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            if ($errors->has('tingkat_kelas')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('tingkat_kelas'),
                ]);
            }elseif ($errors->has('no_kelas')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('no_kelas'),
                ]);
            }elseif ($errors->has('jurusan')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('jurusan'),
                ]);
            }elseif ($errors->has('tahun_masuk')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('tahun_masuk'),
                ]);
            }
        }
        $room = new Room;
        $room->tingkat_kelas = $request->tingkat_kelas;
        $room->no_kelas = $request->no_kelas;
        $room->jurusan = $request->jurusan;
        $room->tahun_masuk = $request->tahun_masuk;
        $room->nama_kelas = $request->tingkat_kelas.' '.$request->jurusan.' '.$request->no_kelas;

        $room->save();
        return response()->json([
            'alert' => 'success',
            'message' => 'Room '. $request->nama_kelas. ' tersimpan',
        ]);
    }
    public function show(Room $room)
    {
        //
    }
    public function edit(Room $room)
    {
        return view('page.admin.class.input', compact('room'));
    }
    public function update(Request $request, Room $room)
    {
        $validator = Validator::make($request->all(), [
            'tingkat_kelas' ,
            'no_kelas' ,
            'jurusan' ,
            'tahun_masuk' ,
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            if ($errors->has('tingkat_kelas')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('tingkat_kelas'),
                ]);
            }elseif ($errors->has('no_kelas')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('no_kelas'),
                ]);
            }elseif ($errors->has('jurusan')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('jurusan'),
                ]);
            }elseif ($errors->has('tahun_masuk')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('tahun_masuk'),
                ]);
            }
        }
        $room->tingkat_kelas = $request->tingkat_kelas;
        $room->no_kelas = $request->no_kelas;
        $room->jurusan = $request->jurusan;
        $room->tahun_masuk = $request->tahun_masuk;
        $room->nama_kelas = $request->tingkat_kelas.' '.$request->jurusan.' '.$request->no_kelas;
        $room->update();
        return response()->json([
            'alert' => 'success',
            'message' => 'Room '. $request->nama_kelas. ' tersimpan',
        ]);
    }
    public function destroy(Room $room)
    {
        $room->delete();
        return response()->json([
            'alert' => 'success',
            'message' => 'Room '. $room->nama_kelas. ' tersimpan',
        ]);
    }
}
