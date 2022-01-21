<?php

namespace App\Http\Controllers;

use App\Models\Tanggapan;
use App\Models\Pengaduan;
use Illuminate\Http\Request;

class TanggapanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        return view('tanggapan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Pengaduan $pengaduan)
    {
        $user = auth()->user();
        if ($user->is_admin) {
            return abort(403);
        }

        request()->validate([
            'isi_laporan' => 'required',
            'status' => 'required|in:process,complete,spam',
          ]);
          $tanggapan = Tanggapan::create([
            'user_id' => auth()->user()->id,
            'pengaduan_id' => $pengaduan->id,
            'tanggal' => date('Y-m-d'),
            'isi_laporan' => request('isi_laporan'),
            'status' => request('status'),
          ]);
          $pengaduan->update([
            'status' => request('status'),
          ]);
          session()->flash('successMessage', 'Data berhasil disimpan');
          return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tanggapan  $tanggapan
     * @return \Illuminate\Http\Response
     */
    public function show(Tanggapan $tanggapan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tanggapan  $tanggapan
     * @return \Illuminate\Http\Response
     */
    public function edit(Tanggapan $tanggapan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tanggapan  $tanggapan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tanggapan $tanggapan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tanggapan  $tanggapan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tanggapan $tanggapan)
    {
        //
    }
}
