@extends('layouts.app')
@section('content')

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        @foreach ($pengaduan as $userPengaduan)
          <div class="card mb-4">
            <div class="card-header">
            <a href="{{ route('pengaduan.show', $userPengaduan->id) }}">
              {{ $userPengaduan->user->name }} -
              {{ $userPengaduan->tanggal }}
            </a>
            </div>
            <div class="card-body">
              {{ $userPengaduan->isi_laporan }}
            </div>
            @if ($userPengaduan->foto)
              <img src="{{ asset($userPengaduan->foto) }}"
                alt="Lampiran">
            @endif
            <div class="card-body">
              <span class="btn btn-sm btn-outline-secondary">
                {{ $userPengaduan->status }}
              </span>
            </div>
          </div>
        @endforeach
        {{ $pengaduan->appends(request()->only([
           'status', 'user_id'
        ]))->links() }}
      </div>
    </div>
  </div>
@endsection
