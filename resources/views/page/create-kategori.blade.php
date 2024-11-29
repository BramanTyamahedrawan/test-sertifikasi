@extends('layouts.app') <!-- Sesuaikan dengan layout utama Anda -->

@section('content')
    <div class="container mt-4">
        <div class="row">
            <!-- Sidebar -->
            @include('layouts.sidebar')
            <div class="col-md-9">
                <h4>Kategori Surat >> Tambah</h4>
                <p>Tambahkan atau edit data kategori. Jika sudah selesai, jangan lupa untuk klik simpan</p>

                <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="kategory_id" class="form-label">ID (auto increment)</label>
                        <input type="text" class="form-control" id="kategory_id" name="kategory_id"
                            value="{{ $nextId }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="nama_kategori" class="form-label">nama kategori</label>
                        <input type="text" class="form-control" id="nama_kategori" name="nama_kategori"
                            placeholder="Masukkan nama kategori" required>
                    </div>

                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul</label>
                        <input type="text" class="form-control" id="judul" name="judul"
                            placeholder="Masukkan judul kategori" required>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="#" class="btn btn-secondary">
                            << Kembali</a>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
