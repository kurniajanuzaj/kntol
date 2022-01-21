<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class PengaduanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengaduan = Pengaduan::with('user')->latest()->paginate(10);
        return view('pengaduan.index', compact('pengaduan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();
        if ($user->is_admin) {
            return abort(403);
         }

        return view('pengaduan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $user = auth()->user();
        if ($user->is_admin) {
        return abort(403);
        }

        request()->validate([
            'isi_laporan' => 'required',
            'foto' => 'nullable|file',
          ]);
          $pengaduan = Pengaduan::create([
            'user_id' => auth()->user()->id,
            'tanggal' => date('Y-m-d'),
            'isi_laporan' => request('isi_laporan'),
          ]);
          $file = request('foto');
          if ($file) {
            $dir = 'uploads';
            $fileName = time() . '-' . str::random(8) . '.' .
            $file->extension();
            $file->move($dir, $fileName);
            $filepath = $dir . '/' . $fileName;
            $pengaduan->foto = $filepath;
            $pengaduan->save();
          }
          session()->flash('successMessage', 'Berhasil membuat pengaduan');
          return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function show(Pengaduan $pengaduan)
    {
        $pengaduan->load('user', 'tanggapan');
        return view('pengaduan.show', compact('pengaduan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengaduan $pengaduan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pengaduan $pengaduan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengaduan $pengaduan)
    {
        //
    }
}
