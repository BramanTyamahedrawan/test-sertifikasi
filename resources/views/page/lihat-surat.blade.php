@extends('layouts.app') <!-- Sesuaikan dengan layout utama Anda -->

@section('content')
    <div class="container mt-4">
        <div class="row">
            <!-- Sidebar -->
            @include('layouts.sidebar')
            <div class="col-md-9">
                <h4>Arsip Surat >> Lihat</h4>
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title
                            ">
                            <p>Nomor : {{ $letter->letter_number }}</p>
                        </h5>
                        <h6 class="card-subtitle mb-2 text-muted">Kategori : {{ $letter->category->name }}</h6>
                        <p class="card-text">Judul : {{ $letter->name }}</p>
                        <p class="text">Waktu Unggah : {{ $letter->created_at }}</p>
                        <iframe src="{{ asset('storage/' . $letter->file) }}" width="100%" height="600px"></iframe>
                    </div>
                </div>
                <div class="d-flex">
                    <a href="{{ route('letter.index') }}" class="btn btn-secondary">
                        Kembali</a>
                    <p class="px-2"></p>
                    <a href="{{ asset('storage/' . $letter->file) }}" class="btn btn-warning"
                        download="{{ $letter->file }}">Unduh</a>
                    <p class="px-2"></p>
                    <a href="{{ route('letter.edit', $letter->id) }}" class="btn btn-primary">
                        Edit/Ganti File</a>
                </div>
            </div>
        </div>
    </div>
@endsection
