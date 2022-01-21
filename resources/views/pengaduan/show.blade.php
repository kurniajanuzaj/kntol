@extends('layouts.app')
@section('content')

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card mb-4">
          <div class="card-header">
            <a href="{{ route('pengaduan.show', $pengaduan->id) }}">
              {{ $pengaduan->user->name }} -
              {{ $pengaduan->posted_at }}
            </a>
          </div>
          <div class="card-body">
            {{ $pengaduan->content }}
          </div>
          @if ($pengaduan->foto)
            <img src="{{ asset($pengaduan->foto) }}"
              alt="Lampiran">
          @endif
          <div class="card-body">
            <span class="btn btn-sm btn-outline-secondary">
              {{ $pengaduan->status }}
            </span>
          </div>
        </div>
        <!-- response form -->
        <div class="card mb-4">
          <div class="card-header">
            Tambahkan Tanggapan
          </div>
          <div class="card-body">
            @if (session('successMessage'))
              <div class="alert alert-success">
                {{ session('successMessage') }}
              </div>
            @endif
            @if ($errors->any())
              <div class="alert alert-danger">
                <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif
            <form method="POST"
               action="{{ route('pengaduan.tanggapan.store', $pengaduan->id) }}"
              enctype="multipart/form-data">
              @csrf
              <div class="form-group row">
                <label
                  for="isi_laporan"
                  class="col-md-4 col-form-label text-md-right">
                  {{ __('Isi Laporan') }}
                </label>
                <div class="col-md-6">
                  <textarea
                    id="isi_laporan"
                    name="isi_laporan"
                    class="form-control
                    @error('isi_laporan') is-invalid @enderror"
                    required
                    rows="5">{{ old('isi_laporan') }}</textarea>
                  @error('content')
                    <span class="invalid-pengaduan" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
              <div class="form-group row">
                <label
                  for="status"
                  class="col-md-4 col-form-label text-md-right">
                  {{ __('Status') }}
                </label>
              <div class="col-md-6">
                <select
                  name="status"
                  id="status"
                  class="form-control
                  @error('status') is-invalid @enderror"
                  required>
                    <option value="">Silahkan Pilih</option>
                    <option value="process" {{ old('status') == 'process' ? 'selected' : '' }}>
                      Process
                    </option>
                    <option value="complete" {{ old('status') == 'complete' ? 'selected' : '' }}>
                      Complete
                    </option>
                    <option value="spam" {{ old('status') == 'spam' ? 'selected' : '' }}>
                    Spam
                    </option>
                  </select>
                  @error('status')
                    <span class="invalid-pengaduan" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
              <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4">
                  <button type="submit" class="btn btn-primary">
                    {{ __('Submit') }}
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>

        @php
        $isAdmin = false;
        if (auth()->check()) {
        $user = auth()->user();
        $isAdmin = $user->is_admin;
        }
    @endphp
    @if ($isAdmin)

        <!-- /response form -->
        <!-- responses -->
    @endif

@if ($pengaduan->tanggapan)
<div class="card mb-4">
  <div class="card-header">
    Tanggapan
  </div>
  <div class="card-body">
    @foreach ($pengaduan->tanggapan as $tanggapan)
      <div class="mb-4">
        <span class="text-muted">
          [{{ $tanggapan->tanggal }}]
        </span>
        <span>
          {{ $tanggapan->isi_laporan }}
        </span>
        <strong>
          ({{ $tanggapan->status }})
        </strong>
      </div>
    @endforeach
  </div>
</div>
@endif
<!-- /responses -->
      </div>
    </div>
  </div>
@endsection
